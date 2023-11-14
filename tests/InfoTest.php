<?php  

namespace App\Tests;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Contract\HttpClient\HttpClientInterface;
use App\Entity\Employee;
use App\Entity\Department;
use App\Entity\Account;

class InfoTest extends KernelTestCase
{
    /**
    * @var EntityManagerInterface 
    */
    protected $doctrine;

    public function setUp(): void
    {
        static::bootKernel();
        $this->doctrine = static::$kernel->getContainer()->get('doctrine')->getManager();
    }

    public function xtestCreateUnitAndFood()
    {
        $food = new UnitFood;
        $food->setName('Icecream');

        $secondFood = new UnitFood;
        $secondFood->setName('Banana');

        $systemFood = [
            $food, $secondFood
        ];

        $person = new Unit;
        $person->setFname('Megan');
        $person->setLname('Foks');
        $person->setAge(34);

        foreach ($systemFood as $s) {
            $this->doctrine->persist($s);
            $person->addUnitFood($s);
        }

        $this->doctrine->persist($person);

        $this->doctrine->flush();
        var_dump ('---done---');
    }

    public function ytestAvadaKedavra()
    {
        $name = 'Jacke';
        
        $spell = $this->doctrine->createQueryBuilder();
        $spell
            ->select('u')
            ->from(Unit::class, 'u')
            ->where(
                $spell->expr()->eq('u.fname', ':fname')
            )
            ->setParameter('fname', $name);


        $magic = $spell->getQuery()->getResult()[0];
        var_dump ($magic -> getLname());
    }

    public function xtestLikeFood()
    {
        /// вытащить любимые блюда в алфавитном порядке
        $name = 'King';
        $unit = $this->doctrine->getRepository(Unit::class)->findOneBy(['fname' => 'Jacke']);
        $unitId = $unit->getId();
        
        $spell = $this->doctrine->createQueryBuilder('u');
        $spell
            ->select('uf.name')
            ->from('App\Entity\Unit', 'u')
            ->join('App\Entity\UnitFood', 'uf')
            ->where(
                $spell->expr()->eq('u.fname', ':fname')
            )
            ->setParameter(':fname', $name);

        $need = $spell->getQuery()->getResult();
        var_dump ($need);
    }

    public function xtestAvadaKedavra()
    {
        $unitRepo = $this->doctrine->getRepository(Unit::class);
        $unitName = 'Megan';
        
        $unitId = $this->doctrine->getRepository(Unit::class)->findOneBy(['fname' => $unitName])->getId();

        $qb = $this->doctrine->createQueryBuilder();
        
        $qb
            ->select('u')
            ->from(Unit::class, 'u')
            ->innerJoin('App\Entity\UnitFood', 'uf', 'WITH', 'uf.unit = :unitId')
            ->where('u.fname = :unitName')
            ->setParameter('unitId', $unitId)
            ->setParameter('unitName', $unitName); 

        $foodInfo = $qb->getQuery()->getResult()[0]->getUnitFood();
        echo "\n";
        foreach ($foodInfo as $fi) {
            echo $fi->getName();
            echo "\n";
        }
        
    }

    public function ytestInfo()
    {
        $spell = $this->doctrine->createQueryBuilder();
        $spell
            ->select('e.id as LOOK', 'e.id * 1000', 'UPPER(e.fname)')
            ->from(Employee::class, 'e');
        $craft = $spell->getQuery()->getResult();
        var_dump ($craft);

    }

    public function testInfo()
    {
        /// найти все продавцов - по сути юзеров у которых есть аккаунты

        /// все аккаунты
        $spell = $this->doctrine->createQueryBuilder();
        $spell
            ->select('a')
            ->from(Account::class, 'a');
        $craft = $spell->getQuery()->getResult();

        /// по приколу все города юзеров
        $cities = [];
        foreach ($craft as $witchcraft) {
            $cities[] = $witchcraft->getCustomer()->getCity();
        }

        var_dump($cities);
    }
    
}
