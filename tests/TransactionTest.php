<?php  

namespace App\Tests;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Contract\HttpClient\HttpClientInterface;
use App\Entity\Transaction;
use App\Entity\Employee;
use App\Entity\Branch;
use App\Entity\Account;
use App\Entity\Product;
use App\Entity\ProductType;
use Carbon\Carbon;

class TransactionTest extends KernelTestCase
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

    public function xtestCreateTransaction()
    {
        var_dump ('---create transaction---');

        /// put $100 in all checking/savings accounts on date account opened
        $employee = $this->doctrine->getRepository(Employee::class)->findOneBy(['fname' => 'Michael']);
        $branch = $employee->getBranch();
        $accounts = $employee->getAccounts();
        //var_dump ($accounts[0]->getAvailBalance());

        $t = new Transaction;
        $t->setTxnDate(Carbon::now());
        $t->setTxnType('TYPE');
        $t->setAmount(1000);
        $t->setFundsAvailDate(Carbon::now());

        $t->setEmployee($employee);
        $t->setBranch($branch);
        $t->setAccount($accounts[0]);

        $this->doctrine->persist($t);
        $this->doctrine->flush($t);
        
    }

    public function yyytestAvadaKedavra()
    {
        /// найди айди сотрудников открывших счета
        $qm = $this->doctrine->createQueryBuilder();
        $qm
            ->select('a')
            ->from(Account::class, 'a')
            ->where(
                $qm->expr()->eq('a.status', ':status')
            )
            ->setParameter('status', Account::STATUS_ACTIVE);

        $accounts = $qm->getQuery()->getResult();
        $employeesIds = [];

        foreach ($accounts as $account) {
            $employeesIds[] = $account->getEmployee()->getId();
        }

        var_dump ($employeesIds);
    }

    public function testLookingAvada()
    {
        /// найти все счета(продукты) являющимися лицевыми счетами Customer Accounts
        $qm = $this->doctrine->createQueryBuilder();
        $qm
            ->select('p')
            ->from(Product::class, 'p')
            ->innerJoin(ProductType::class, 'pt', 'WITH', 'p.product_type=pt.id')
            ->where(
                $qm->expr()->eq('pt.id', ':product_type')
            )
            ->setParameter('product_type', ProductType::ACCOUNT);
            
        $product_account = $qm->getQuery()->getResult()[0]->getName();
        var_dump ($product_account);
    }
}
