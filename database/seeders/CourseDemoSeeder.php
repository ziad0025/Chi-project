<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Course;
use Illuminate\Support\Facades\Hash;

class CourseDemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. إنشاء مجموعة من الطلاب التجريبيين
     $students = [
            ['name' => 'أحمد محمود', 'email' => 'ahmed@example.com', 'phone' => '01012345678'],
            ['name' => 'سارة علي', 'email' => 'sara@example.com', 'phone' => '01112345678'],
            ['name' => 'عمر خالد', 'email' => 'omar@example.com', 'phone' => '01212345678'],
            ['name' => 'مريم يوسف', 'email' => 'maryam@example.com', 'phone' => '01512345678'],
            ['name' => 'محمد إبراهيم', 'email' => 'mohamed@example.com', 'phone' => '01098765432'],
        ];

        $studentModels = [];
        foreach ($students as $student) {
            $studentModels[] = User::firstOrCreate(
                ['email' => $student['email']],
                [
                    'name' => $student['name'],
                    'phone' => $student['phone'], // إضافة رقم الهاتف هنا
                    'password' => Hash::make('password'),
                    'role' => 'student',
                ]
            );
        }

        // 2. إنشاء مجموعة من المواد الدراسية التجريبية
        $courses = [
            [
                'title' => 'مقدمة في البرمجة وتركيب البيانات',
                'description' => 'مادة أساسية تغطي مفاهيم البرمجة الهيكلية والخوارزميات وتركيب البيانات الأساسية.',
                'grade' => 'الفرقة الأولى',
                'price' => 0.00,
                'is_published' => true,
            ],
            [
                'title' => 'تصميم وتطوير مواقع الويب (Laravel)',
                'description' => 'تعلم كيفية بناء تطبيقات ويب متكاملة باستخدام إطار العمل لاراول والتقنيات الحديثة.',
                'grade' => 'الفرقة الثانية',
                'price' => 350.00,
                'is_published' => true,
            ],
            [
                'title' => 'قواعد البيانات وأنظمة إدارة المعلومات (SQL)',
                'description' => 'دراسة تصميم قواعد البيانات العلاقاتية وشبكات البيانات ولغة SQL.',
                'grade' => 'الفرقة الثانية',
                'price' => 200.00,
                'is_published' => true,
            ],
            [
                'title' => 'هندسة البرمجيات والأنظمة الموزعة',
                'description' => 'مادة متقدمة في دورة حياة تطوير البرمجيات وأنماط التصميم Architecture.',
                'grade' => 'الفرقة الثالثة',
                'price' => 450.00,
                'is_published' => false, // مسودة للتجربة في الداشبورد
            ],
            [
                'title' => 'الذكاء الاصطناعي وتعلم الآلة',
                'description' => 'مقدمة في خوارزميات الذكاء الاصطناعي وتعلم الآلة مع التطبيق العملي.',
                'grade' => 'الفرقة الرابعة',
                'price' => 500.00,
                'is_published' => true,
            ],
        ];

        foreach ($courses as $courseData) {
            $course = Course::create($courseData);

            // 3. ربط مجموعة عشوائية من الطلاب بكل كورس لتجربة جدول الربط والـ Charts
            if ($course->is_published) {
                // نختار عدد عشوائي من الطلاب ونربطهم بالكورس
                $randomStudents = collect($studentModels)->random(rand(2, 4))->pluck('id');
                $course->users()->attach($randomStudents);
            }
        }
    }
}
