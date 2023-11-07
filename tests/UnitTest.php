<?php  

namespace App\Tests;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Contract\HttpClient\HttpClientInterface;
use App\Service\Products;
use App\Entity\ProductType;
use App\Entity\Department;
use App\Entity\Branch;
use App\Entity\Customer;
use App\Entity\Bio;
use App\Entity\Employee;
use App\Entity\Account;
use App\Entity\Product;
use Carbon\Carbon;

class UnitTest extends KernelTestCase
{
    /**
    * @var Products
    */
    protected $products;

    public function setUp(): void
    {
        static::bootKernel();
        $this->products = static::$kernel->getContainer()->get(Products::class);
        $this->doctrine = static::$kernel->getContainer()->get('doctrine')->getManager();
    }
    
    public function createProduct()
    {
        var_dump ('---avada kedavra---');

        $typesA = $this->doctrine->getRepository(ProductType::class)->findOneBy(['id' => ProductType::ACCOUNT]);
        $typesL = $this->doctrine->getRepository(ProductType::class)->findOneBy(['id' => ProductType::LOAN]);
        $typesI = $this->doctrine->getRepository(ProductType::class)->findOneBy(['id' => ProductType::INSURANCE]);

        $instance0 = $this->products->getInstance();
        $instance1 = $this->products->getInstance();
        $instance2 = $this->products->getInstance();
        $instance3 = $this->products->getInstance();
        $instance4 = $this->products->getInstance();
        $instance5 = $this->products->getInstance();
        $instance6 = $this->products->getInstance();
        $instance7 = $this->products->getInstance();

        $this->doctrine->persist($instance0);
        $this->doctrine->persist($instance1);
        $this->doctrine->persist($instance2);
        $this->doctrine->persist($instance3);
        $this->doctrine->persist($instance4);
        $this->doctrine->persist($instance5);
        $this->doctrine->persist($instance6);
        $this->doctrine->persist($instance7);

        $instance0->setName('checking account');
        $instance0->setProductType($typesA);
        $instance1->setName('savngs account');
        $instance1->setProductType($typesA);
        $instance2->setName('money market account');
        $instance2->setProductType($typesA);
        $instance3->setName('certificate of deposit');
        $instance3->setProductType($typesA);
        $instance4->setName('home mortgage');
        $instance4->setProductType($typesL);
        $instance5->setName('auto loan');
        $instance5->setProductType($typesL);
        $instance6->setName('business line of credit');
        $instance6->setProductType($typesL);
        $instance7->setName('small business loan');
        $instance7->setProductType($typesL);

        $this->doctrine->flush();
    }

    public function createDepartment()
    {
        var_dump ('---createor---');
        $operations = new Department;
        $operations->setName('Operations');

        $loans = new Department;
        $loans->setName('Loans');

        $administration = new Department;
        $administration->setName('Administration');

        $system = [
            $operations, $loans, $administration
        ];

        foreach ($system as $s) {
            $this->doctrine->persist($s);
        }

        $this->doctrine->flush();
    }

    public function createBranch()
    {
        $branch0 = new Branch;
        $branch1 = new Branch;
        $branch2 = new Branch;
        $branch3 = new Branch;

        $branch0->setName('Headquarters');
        $branch0->setAddress('3882 Main Static.');
        $branch0->setCity('Waltham');
        $branch0->setState('MA');
        $branch0->setZip('02351');

        $branch1->setName('Woburn Branch');
        $branch1->setAddress('422 Maple St');
        $branch1->setCity('Woburn');
        $branch1->setState('MA');
        $branch1->setZip('01801');


        $branch2->setName('Quincey Branch');
        $branch2->setAddress('125 Presidential Way');
        $branch2->setCity('Quincy');
        $branch2->setState('MA');
        $branch2->setZip('02169');

        $branch3->setName('So. NH Branch');
        $branch3->setAddress('387 Maynard Ln.');
        $branch3->setCity('Salem');
        $branch3->setState('NH');
        $branch3->setZip('03079');

        $this->doctrine->persist($branch0);
        $this->doctrine->persist($branch1);
        $this->doctrine->persist($branch2);
        $this->doctrine->persist($branch3);
        
        $this->doctrine->flush();
    }

    public function createCustomer()
    {
        $c0 = new Customer;
        $c1 = new Customer;
        $c2 = new Customer;
        $c3 = new Customer;
        $c4 = new Customer;

        $c0->setFedId('111-11-1111');
        $c0->setCustType('I');
        $c0->setAddress('47 Mockingbird Ln');
        $c0->setCity('Lynnfield');
        $c0->setState('MA');
        $c0->setPostalCode('01940');

        $c1->setFedId('222-22-2222');
        $c1->setCustType('I');
        $c1->setAddress('372 Clearwater Blvd');
        $c1->setCity('Woburn');
        $c1->setState('MA');
        $c1->setPostalCode('01801');

        $c2->setFedId('333-33-3333');
        $c2->setCustType('I');
        $c2->setAddress('18 Jessup Rd');
        $c2->setCity('Quincey');
        $c2->setState('MA');
        $c2->setPostalCode('02169');

        $c3->setFedId('444-44-4444');
        $c3->setCustType('I');
        $c3->setAddress('12 Buchanan Ln');
        $c3->setCity('Waltham');
        $c3->setState('MA');
        $c3->setPostalCode('02451');

        $c4->setFedId('555-55-5555');
        $c4->setCustType('I');
        $c4->setAddress('2341 Main St');
        $c4->setCity('Salem');
        $c4->setState('NH');
        $c4->setPostalCode('03079');

        $system = [
            $c1, $c2, $c3, $c4
        ];

        foreach ($system as $s) {
            $this->doctrine->persist($s);
        }

        $this->doctrine->flush();
    }

    public function createIndividual()
    {
        $c0 = $this->doctrine->getRepository(Customer::class)->findOneBy(['fed_id' => '222-22-2222']);
        $c1 = $this->doctrine->getRepository(Customer::class)->findOneBy(['fed_id' => '333-33-3333']);
        $c2 = $this->doctrine->getRepository(Customer::class)->findOneBy(['fed_id' => '444-44-4444']);
        $c3 = $this->doctrine->getRepository(Customer::class)->findOneBy(['fed_id' => '555-55-5555']);
        
        $bio0 = new Bio;
        $bio1 = new Bio;
        $bio2 = new Bio;
        $bio3 = new Bio;

        $bio0->setFname('Jacke');
        $bio0->setLname('Diamonds');
        $bio0->setBirthDate(Carbon::createFromDate(1987, 10, 10));
        $bio0->setCustomer($c0);

        $bio1->setFname('Queen');
        $bio1->setLname('Hearts');
        $bio1->setBirthDate(Carbon::createFromDate(1987, 10, 10));
        $bio1->setCustomer($c1);

        $bio2->setFname('King');
        $bio2->setLname('Clubs');
        $bio2->setBirthDate(Carbon::createFromDate(1987, 10, 10));
        $bio2->setCustomer($c2);

        $bio3->setFname('Dolly');
        $bio3->setLname('Spades');
        $bio3->setBirthDate(Carbon::createFromDate(1987, 10, 10));
        $bio3->setCustomer($c3);

        $system = [
            $bio0, $bio1, $bio2, $bio3
        ];

        foreach ($system as $s) {
            $this->doctrine->persist($s);
        }

        $this->doctrine->flush();
    }

    public function createEmployee()
    {
        $e0 = new Employee;
        $e1 = new Employee;
        $e2 = new Employee;
        $e3 = new Employee;

        $spell = $this->doctrine->createQueryBuilder();
        $spell
            ->select('d')
            ->from(Department::class, 'd')
            ->where(
                $spell->expr()->eq('d.name', ':name')
            )
            ->setParameter('name', 'Administration');
        
        $departmentAdministration = $spell->getQuery()->getResult()[0];

        $bspell = $this->doctrine->createQueryBuilder();
        $bspell
            ->select('b')
            ->from(Branch::class, 'b')
            ->where(
                $bspell->expr()->eq('b.name', ':name')
            )
            ->setParameter('name', 'Headquarters');
        $branchHeadquarters = $bspell->getQuery()->getResult()[0];

        $e0->setFname('Michael');
        $e0->setLname('Smith');
        $e0->setTitle('President');
        $e0->setStartDate(Carbon::now());
        $e0->setDepartment($departmentAdministration);
        $e0->setBranch($branchHeadquarters);

        $e1->setFname('Susan');
        $e1->setLname('Barker');
        $e1->setTitle('Vice President');
        $e1->setStartDate(Carbon::now());
        $e1->setDepartment($departmentAdministration);
        $e1->setBranch($branchHeadquarters);


        $e2->setFname('Robert');
        $e2->setLname('Tyler');
        $e2->setTitle('Treasurer');
        $e2->setStartDate(Carbon::now());
        $e2->setDepartment($departmentAdministration);
        $e2->setBranch($branchHeadquarters);

        $operations_spell = $this->doctrine->createQueryBuilder();
        $operations_spell
            ->select('d')
            ->from(Department::class, 'd')
            ->where(
                $operations_spell->expr()->eq('d.name', ':name')
            )
            ->setParameter('name', 'Operations');
        $operations_department = $operations_spell->getQuery()->getResult()[0];
        
        $e3->setFname('Susan');
        $e3->setLname('Hawthorne');
        $e3->setTitle('Operations Manager');
        $e3->setStartDate(Carbon::now());
        $e3->setDepartment($operations_department);
        $e3->setBranch($branchHeadquarters);

        $system = [
            $e0, $e1, $e2, $e3
        ];

        foreach ($system as $sys) {
            $this->doctrine->persist($sys);
        }
        $this->doctrine->flush();
    }

    public function testCreateAccount()
    {
        var_dump ('---create account---');

        $a0 = new Account;

        $customer = $this->doctrine->getRepository(Customer::class)->findOneBy(['fed_id' => '222-22-2222']);
        $branch = $this->doctrine->getRepository(Branch::class)->findOneBy(['city' => 'Woburn']);
        $product = $this->doctrine->getRepository(Product::class)->findOneBy(['id' => 3]);
        $employee = $this->doctrine->getRepository(Employee::class)->findOneBy(['title' => 'President']);

        $a0->setOpenDate(Carbon::now());
        $a0->setLastActivity(Carbon::now());
        $a0->setStatus('ACTIVE');
        $a0->setAvailBalance(10000);
        $a0->setPendingBalance(1000);

        $a0->setProduct($product);
        $a0->setCustomer($customer);
        $a0->setEmployee($employee);

        $this->doctrine->persist($a0);
        $this->doctrine->flush();
    }
}
