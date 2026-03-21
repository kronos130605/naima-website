<?php

namespace App\Repositories\Site;

class HomeContentRepository
{
    public function get(): array
    {
        return [
            'brand' => [
                'name' => 'FrenchBoost',
            ],
            'cta' => [
                'booking_url' => null,
            ],
            'about' => [
                'title' => 'Who I am?',
                'body' => "Hello! I’m Naima an experienced online tutor who has worked with learners from kindergarten through university, accumulating over 4,000 hours of tutoring experience.\n\nHaving studied in both France and my lifelong passion for learning, fueled by my own education and professional experience, drives me to inspire the same enthusiasm in my students.\n\nI have extensive experience in supporting students from all backgrounds, including those facing ADHD, test anxiety, and language barriers, helping them build confidence and strengthen their skills. This experience allows me to meet students where they are and guide them toward meaningful progress.\n\nAfter years of tutoring, I developed the FrenchBoost Learning Strategy: Learn, Apply, Grow, a method designed to help learners boost their French skills and unlock their full potential.",
            ],
            'strategy' => [
                'title' => 'The FrenchBoost Learning Strategy: Learn, Apply, Grow.',
                'items' => [
                    [
                        'key' => 'learn',
                        'title' => 'Learn',
                        'body' => "Lessons are personalized to each student’s level and learning style, keeping every child engaged in a fun, positive environment that makes learning French enjoyable and effective.",
                    ],
                    [
                        'key' => 'apply',
                        'title' => 'Apply',
                        'body' => 'Students actively apply the skills and strategies they have learned through interdisciplinary projects and various activities, while enhancing their French communication.',
                    ],
                    [
                        'key' => 'grow',
                        'title' => 'Grow',
                        'body' => 'Students build self-confidence, French skills while developing 21st-century skills—like planning, researching, summarizing, problem-solving, critical thinking, and creativity—they can use every day, in school and beyond, preparing them for lifelong success.',
                    ],
                ],
            ],
            'benefits' => [
                'title' => 'FrenchBoost can give your child a lifetime of advantages.',
                'items' => [
                    [
                        'key' => 'quality',
                        'title' => 'Quality of teaching',
                        'body' => 'Give your child online French lessons that make learning fun, engaging, and easy to understand.',
                    ],
                    [
                        'key' => 'results',
                        'title' => 'Progress and Results',
                        'body' => 'Watch your child improve in French communication, and 21st-century skills.',
                    ],
                    [
                        'key' => 'flexibility',
                        'title' => 'Flexibility & Convenience',
                        'body' => 'Relax knowing online lessons fit your schedule, can be adjusted for last-minute changes, and make learning stress-free.',
                    ],
                ],
            ],
            'pricing' => [
                'title' => 'Pricing',
                'subtitle' => 'Online French class, Grades K to 12.',
                'currency' => null,
                'packages' => [
                    [
                        'name' => 'The Tartelette package',
                        'details' => [
                            'Grades K-12',
                            '1-on-1 training $35 per hour',
                        ],
                    ],
                    [
                        'name' => 'The Macaron package',
                        'details' => [
                            'Grades K-12',
                            '1-on-1 training 8 hours for $240 — $30 per hour',
                        ],
                    ],
                    [
                        'name' => 'The Croissant package',
                        'details' => [
                            'Grades 1-12',
                            'Group Conversation Class for Beginners',
                            '2 hours for $50',
                            'Dates: (TBD)',
                        ],
                    ],
                ],
            ],
            'stats' => [
                'items' => [
                    ['value' => '4,000+', 'lang_key' => 'label_hours'],
                    ['value' => 'K–12',   'lang_key' => 'label_grades'],
                    ['value' => '100%',   'lang_key' => 'label_online'],
                    ['value' => '5★',     'lang_key' => 'label_rating'],
                ],
            ],
            'programs' => [
                'title' => 'Programs for Every Level',
                'items' => [
                    [
                        'title'  => 'Beginner',
                        'grades' => 'Kindergarten – Grade 3',
                        'body'   => 'A playful, immersive introduction to French — alphabet, colours, numbers, greetings and simple sentences in a fun, stress-free environment.',
                        'tags'   => ['Vocabulary', 'Pronunciation', 'Phonics', 'Songs & Games'],
                    ],
                    [
                        'title'  => 'Intermediate',
                        'grades' => 'Grade 4 – Grade 8',
                        'body'   => 'Structured grammar, reading comprehension and oral expression to help students build fluency and excel in school French programs.',
                        'tags'   => ['Grammar', 'Reading', 'Writing', 'Oral Skills'],
                    ],
                    [
                        'title'  => 'Advanced',
                        'grades' => 'Grade 9 – Grade 12',
                        'body'   => 'Targeted preparation for high-school exams and provincial assessments, with focus on essay writing, literary analysis and advanced conversation.',
                        'tags'   => ['Exam Prep', 'Essay Writing', 'Literature', 'Debate'],
                    ],
                ],
            ],
            'testimonials' => [
                'title' => 'What Families Are Saying',
                'items' => [
                    [
                        'name'   => 'Sarah M.',
                        'role'   => 'Parent of a Grade 5 student',
                        'rating' => 5,
                        'body'   => 'Naima is absolutely wonderful! My daughter went from dreading French class to looking forward to every lesson. Her grades improved significantly within two months.',
                    ],
                    [
                        'name'   => 'James T.',
                        'role'   => 'Parent of a Grade 10 student',
                        'rating' => 5,
                        'body'   => 'The personalized approach made all the difference. Naima identified exactly where my son was struggling and created a plan that worked. He passed his provincial exam with flying colours.',
                    ],
                    [
                        'name'   => 'Priya K.',
                        'role'   => 'Parent of a Grade 2 student',
                        'rating' => 5,
                        'body'   => 'Naima is great! The lessons are clear, personalized, and motivating. My child is always excited to learn new French words and songs.',
                    ],
                    [
                        'name'   => 'Marc D.',
                        'role'   => 'Grade 12 student',
                        'rating' => 5,
                        'body'   => 'I was completely lost in my French class and Naima helped me get back on track fast. Her teaching style is patient and super clear. Best investment before my finals.',
                    ],
                    [
                        'name'   => 'Linda C.',
                        'role'   => 'Parent of a Grade 7 student',
                        'rating' => 5,
                        'body'   => 'Flexible scheduling and outstanding quality. Naima accommodates our busy schedule and always comes prepared with engaging activities. Highly recommend!',
                    ],
                    [
                        'name'   => 'Aisha R.',
                        'role'   => 'Parent of two students',
                        'rating' => 5,
                        'body'   => 'Both of my children have lessons with Naima and the results have been remarkable for both of them, even though they are at very different levels. She adapts so well.',
                    ],
                ],
            ],
            'resources' => [
                'title' => 'Free Learning Resources',
                'items' => [],
            ],
            'faq' => [
                'title' => 'FAQ',
                'items' => [
                    [
                        'q' => 'What is the FrenchBoost Learning Strategy?',
                        'a' => "This framework focuses on each student’s needs and strengths. It encourages clear goals, positive learning habits, and an engaging learning experience that helps students become confident French speakers while developing success in school and beyond.",
                    ],
                    [
                        'q' => 'Why did you become a French teacher?',
                        'a' => "I enjoy learning and sharing the joy, and opportunities that come with learning a new language. A language becomes even more interesting when it's connected to culture, food, idioms, and history. Teaching a new language is a true passion of mine.",
                    ],
                    [
                        'q' => 'How are the meetings organized?',
                        'a' => 'We will work together to find a date that works for both of us, so I will do my best to accommodate your schedule.',
                    ],
                    [
                        'q' => 'Where will we meet for our online lesson?',
                        'a' => 'I will use Google Meet or Zoom for meetings.',
                    ],
                    [
                        'q' => 'What will my first lesson look like?',
                        'a' => 'I will create a customized plan based on your needs and goals. Throughout the course, I will use a variety of tools to keep you engaged and motivated towards achieving your goals.',
                    ],
                    [
                        'q' => 'How do I pay?',
                        'a' => 'Payments can be made by bank transfer after each lesson. For package deals, payment must be made before the course starts.',
                    ],
                    [
                        'q' => 'What is the procedure if I cancel a course?',
                        'a' => 'I understand that unexpected events such as illness can happen. However, if you are going to miss a session or need to reschedule it, please let me know at least 24h in advance. Otherwise, you will be charged the full amount. Thank you for your understanding and cooperation.',
                    ],
                    [
                        'q' => "What's your favorite quote?",
                        'a' => '"It always seems impossible until it’s done." — Nelson Mandela',
                    ],
                ],
            ],
            'contact' => [
                'title' => 'Contact',
                'email' => null,
                'phone' => null,
            ],
        ];
    }
}
