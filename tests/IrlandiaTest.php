<?php  

namespace App\Tests;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Contract\HttpClient\HttpClientInterface;
use App\Entity\Xproduct;
use App\Entity\Trader;
use App\Entity\Terminal;
use App\Entity\MSFT;
use Carbon\Carbon;

/**
 * эмулятор трейдинга
 * у терминала обязательно должен быть статус
 * например статус 0 - открытая сделка
 * статус 1 - закрытая сделка
 * 
 */
class IrlandiaTest extends KernelTestCase
{
    /**
    * @var EntityManagerInterface
    */
    protected $doctrine;

    /**
    * @var HttpClientInterface
    */
    protected $client;

    public function setUp(): void
    {
        static::bootKernel();
        $this->doctrine = static::$kernel->getContainer()->get('doctrine')->getManager();
    }

    public function yxytestRegistrationTrader()
    {
        /// регистрация Трейдера
        $trader = new Trader;
        $trader->setFname('Jacke');
        $trader->setLname('Diamonds');
        $trader->setTraderAccount(10000);

        /// пусть он зарегался но не вошел в позицию еще
        $this->doctrine->persist($trader);
        $this->doctrine->flush();
        var_dump ($trader);
    }


    /**
    * Трейдер зарегался и делает вход в  сделку. 
    * 
    */
    public function lalxtestTraderMakeTrade()
    {
        /// далее фиксируется позиция ключевое значение играет время сделки когда трейдер входит в сделку
        $time_position = new \DateTime('2021-12-01');
        //var_dump ($time_position->format('Y-m-d H:i:s'));

        /// how datetim in msft
        ///$msft = $this->doctrine->getRepository(MSFT::class)->findOneBy(['date' => $time_position]);
        ///var_dump ($msft);die();
        
        /// с помощью аутентификации достается этот трейдер он же юзер и вот он перед нами
        $trader = $this->doctrine->getRepository(Trader::class)->findOneBy(['fname' => 'Jacke']);

        /// теперь трейдер делает сделку
        /// активирует создание Терминала
        $terminal = new Terminal;
        
        /// трейдера привязать к терминалу
        $terminal->setTrader($trader);
        
        /// может быть также вызывается Инструмент конкретный
        /// типа нажимается кнопка и прилетает строка
        $string = 'MSFT';

        /// сразу в терминале фиксируется инструмент
        $terminal->setInstrument($string);

        /// вызывается ценовое поле этой компании (цены - ключевое во всей программе)
        $company_string = 'App\\Entity\\' . $string;
        
        /// найти цену открытия по временной позиции трейдера
        $price_position = $this->doctrine->getRepository(MSFT::class)->findOneBy(['date' => $time_position])->getOpenPrice();
        var_dump ($price_position);

        /// записать эту цену открытия в терминал
        $terminal->setPosEntry($price_position);
        
        /// теперь когда трейдер сделает какое либо действие - нажмет на кнопку в терминале активируется end_position
        /// а пока эта сфира закрывается сохранением текующего действия
        $this->doctrine->persist($terminal);
        $this->doctrine->flush();
    }

    /**
    * трейдер нажимает на кнопку - закрывает сделку 
    */
    public function testCloseTrade()
    {
        /// опять же ключевое - это время, когда трейдер закрывает сделку - допустим через код от открытия (инвесторская позиция)
        $time_position = new \DateTime('2022-11-01');

        /// при нажатии на кнопку отдается тайтл инструмента
        $instrument_title = 'MSFT';
        $need_class = 'App\\Entity\\'. $instrument_title;

        /// при нажатии на кнопку отдается айди терминала
        $id = 1;
        $terminal = $this->doctrine->getRepository(Terminal::class)->findOneBy(['id' => $id]);

        ///var_dump ($terminal);

        /// теперь получаем трейдера от терминала
        $trader = $terminal->getTrader();

        /// найти цену инструмента по позиции закрытия
        $price_close = $this->doctrine->getRepository($need_class)->findOneBy(['date' => $time_position])->getClosePrice();

        /// зафиксировать позицию закрытия трейда
        $terminal->setPosClose($price_close);

        /// вычислить трейд
        $open = $terminal->getPosEntry();
        $close = $terminal->getPosClose();
        $res = $open - $close;

        /// зафиксировать трейд
        $terminal->setTradingResult($res);

        /// поставить терминалу статус закрытый трейд
        $terminal->setStatus(Terminal::CLOSE_TRADE);

        /// самое важное - осуществить у трейдера (вообще это нужно через аккаунт) вычисление трейда в его счету
        /// сделаю такую колонку - change_account
        $balance = $trader->getTraderAccount();
        $trader->setTraderAccount($balance + $res);

        $this->doctrine->persist($terminal);
        $this->doctrine->persist($trader);
        $this->doctrine->flush();
    }
}
