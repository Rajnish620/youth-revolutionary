<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\EventGroup;
use App\Models\EventRegistration;
use App\Models\PaymentSetting;
use Illuminate\Database\Seeder;

class EventRegistrationSeeder extends Seeder
{
    public function run(): void
    {
        // Seed default Payment Settings
        PaymentSetting::getSettings();

        // Get created events
        $event1 = Event::first();
        if ($event1) {
            // Group A: Class 5 & 6 (Fee ₹100)
            $groupA = EventGroup::create([
                'event_id' => $event1->id,
                'group_name' => 'Group A (Class 5th & 6th)',
                'class_range' => '5th, 6th',
                'fee' => 100.00,
                'max_participants' => 100,
            ]);

            // Group B: Class 7 & 8 (Fee ₹150)
            $groupB = EventGroup::create([
                'event_id' => $event1->id,
                'group_name' => 'Group B (Class 7th & 8th)',
                'class_range' => '7th, 8th',
                'fee' => 150.00,
                'max_participants' => 100,
            ]);

            // Group C: Class 9 & 10 (Fee ₹200)
            $groupC = EventGroup::create([
                'event_id' => $event1->id,
                'group_name' => 'Group C (Class 9th & 10th)',
                'class_range' => '9th, 10th',
                'fee' => 200.00,
                'max_participants' => 100,
            ]);

            // Seed Sample Students
            EventRegistration::create([
                'event_id' => $event1->id,
                'event_group_id' => $groupA->id,
                'roll_no' => 'YR-2026-1001',
                'student_name' => 'Rahul Kumar',
                'father_name' => 'Ramesh Kumar',
                'school_name' => 'St. Xavier Public School',
                'student_class' => 'Class 5th',
                'mobile' => '9876543210',
                'fee_paid' => 100.00,
                'photo' => 'images/NIKON Z 502317.JPG.jpeg',
                'payment_screenshot' => 'images/quize.jpg',
                'payment_status' => 'approved',
                'marks' => 94.50,
                'rank' => '1st Position',
                'certificate_enabled' => true,
            ]);

            EventRegistration::create([
                'event_id' => $event1->id,
                'event_group_id' => $groupA->id,
                'roll_no' => 'YR-2026-1002',
                'student_name' => 'Priya Sharma',
                'father_name' => 'Sunil Sharma',
                'school_name' => 'DAV High School',
                'student_class' => 'Class 6th',
                'mobile' => '9876543211',
                'fee_paid' => 100.00,
                'photo' => 'images/danses.jpeg',
                'payment_screenshot' => 'images/quize.jpg',
                'payment_status' => 'approved',
                'marks' => 88.00,
                'rank' => '2nd Position',
                'certificate_enabled' => true,
            ]);

            EventRegistration::create([
                'event_id' => $event1->id,
                'event_group_id' => $groupB->id,
                'roll_no' => 'YR-2026-1003',
                'student_name' => 'Aman Verma',
                'father_name' => 'Vijay Verma',
                'school_name' => 'Central Public School',
                'student_class' => 'Class 7th',
                'mobile' => '9876543212',
                'fee_paid' => 150.00,
                'photo' => 'images/FB_IMG_1780913014941.jpg.jpeg',
                'payment_screenshot' => 'images/quize.jpg',
                'payment_status' => 'pending',
                'marks' => null,
                'rank' => null,
                'certificate_enabled' => false,
            ]);
        }
    }
}
