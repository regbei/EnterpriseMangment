<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Bank;
use App\Models\Role;
use App\Models\Branch;
use App\Models\Department;
use App\Models\AccountInfo;
use App\Models\AllowanceType;
use App\Models\DeductionType;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        
        
        Department::create(['name'=>'الحسابات','employee_id'=>1231232131]);
        Department::create(['name'=>'الشؤون القانونية','employee_id'=>1231232131]);
        Department::create(['name'=>'موارد بشرية','employee_id'=>123123214]);
        Branch::create(['name'=>'الفرع الرئيسي','location'=>'الخرطوم']);
        Branch::create(['name'=>'الفرع ألف','location'=>'بورتسودان']);
        AllowanceType::create(['name'=>'بدل علاج', 'description'=>'بدل علاج']);
        AllowanceType::create(['name'=>'بدل ترحيل', 'description'=>'بدل ترحيل']);
        AllowanceType::create(['name'=>'حافز عيد', 'description'=>'حافز عيد']);
        AllowanceType::create(['name'=>'حافز الأضحى المبارك', 'description'=>'عيدية الأضحى المبارك']);
        DeductionType::create(['name'=>'تأمين صحي', 'description'=>'إستقطاع خاص بالتأمين الصحي']);
        DeductionType::create(['name'=>'سلفية مباني', 'description'=>'سلفية مباني']);
        DeductionType::create(['name'=>'تمويل زواج', 'description'=>'إستقطاع التكافل الإجتماعي']);
        DeductionType::create(['name'=>'ضريبة دخل', 'description'=>'ضريبة دخل إضافي']);
        Role::create(['name'=>'Admin']);
        Role::create(['name'=>'Manager']);
        Role::create(['name'=>'Accountant']);
        Role::create(['name'=>'Guest']);

        Bank::create(['name'=>'بنك الخرطوم','swiftKey'=>'54462000130003003','branch'=>'بورتسودان']);
        Bank::create(['name'=>'بنك السودان المركزي','swiftKey'=>'02313100232020','branch'=>'عطبرة']);
        Bank::create(['name'=>'بنك المال المتحد','swiftKey'=>'55550000312353','branch'=>'لندن']);
        AccountInfo::create(['acc_number'=> '8353581', 'owner_name'=>'وزارة المالية', 'phone'=>'0123022555', 'email'=> 'Mf@mail.gov']);
        AccountInfo::create(['acc_number'=> '653210', 'owner_name'=>'معمار المرشدي', 'phone'=>'0123022555', 'email'=> 'Cbos@mail.gov']);
        AccountInfo::create(['acc_number'=> '12023201', 'owner_name'=>'شركة الوطنية للنفط', 'phone'=>'0123022555', 'email'=> 'CNCO@mail.gov']);
    }
}
