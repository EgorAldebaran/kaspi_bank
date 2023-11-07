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
}
