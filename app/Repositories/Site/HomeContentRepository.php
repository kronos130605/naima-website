<?php

namespace App\Repositories\Site;

class HomeContentRepository
{
    public function get(string $locale = 'en'): array
    {
        return $locale === 'fr' ? $this->getFr() : $this->getEn();
    }

    private function getEn(): array
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

    private function getFr(): array
    {
        return [
            'brand' => [
                'name' => 'FrenchBoost',
            ],
            'cta' => [
                'booking_url' => null,
            ],
            'about' => [
                'title' => 'Qui suis-je ?',
                'body' => "Bonjour ! Je m'appelle Naima, tutrice en ligne expérimentée ayant travaillé avec des apprenants de la maternelle à l'université, accumulant plus de 4 000 heures d'expérience en tutorat.\n\nAyant étudié en France et animée par ma passion pour l'apprentissage, alimentée par ma propre éducation et mon expérience professionnelle, je m'efforce d'inspirer le même enthousiasme chez mes élèves.\n\nJ'ai une vaste expérience dans l'accompagnement d'élèves de tous horizons, y compris ceux confrontés au TDAH, à l'anxiété liée aux examens et aux barrières linguistiques, les aidant à renforcer leur confiance et leurs compétences. Cette expérience me permet de rencontrer les élèves là où ils en sont et de les guider vers des progrès significatifs.\n\nAprès des années de tutorat, j'ai développé la méthode FrenchBoost : Apprendre, Appliquer, Progresser, une approche conçue pour aider les apprenants à booster leurs compétences en français et libérer leur plein potentiel.",
            ],
            'strategy' => [
                'title' => 'La méthode FrenchBoost : Apprendre, Appliquer, Progresser.',
                'items' => [
                    [
                        'key' => 'learn',
                        'title' => 'Apprendre',
                        'body' => "Les leçons sont personnalisées selon le niveau et le style d'apprentissage de chaque élève, gardant chaque enfant engagé dans un environnement amusant et positif qui rend l'apprentissage du français agréable et efficace.",
                    ],
                    [
                        'key' => 'apply',
                        'title' => 'Appliquer',
                        'body' => "Les élèves appliquent activement les compétences et stratégies qu'ils ont apprises à travers des projets interdisciplinaires et diverses activités, tout en améliorant leur communication en français.",
                    ],
                    [
                        'key' => 'grow',
                        'title' => 'Progresser',
                        'body' => "Les élèves renforcent leur confiance en eux et leurs compétences en français tout en développant des compétences du 21e siècle — comme la planification, la recherche, la synthèse, la résolution de problèmes, la pensée critique et la créativité — qu'ils peuvent utiliser au quotidien, à l'école et au-delà, les préparant à un succès durable.",
                    ],
                ],
            ],
            'benefits' => [
                'title' => 'FrenchBoost peut offrir à votre enfant des avantages pour toute une vie.',
                'items' => [
                    [
                        'key' => 'quality',
                        'title' => 'Qualité de l\'enseignement',
                        'body' => 'Offrez à votre enfant des cours de français en ligne qui rendent l\'apprentissage amusant, engageant et facile à comprendre.',
                    ],
                    [
                        'key' => 'results',
                        'title' => 'Progrès et Résultats',
                        'body' => 'Regardez votre enfant s\'améliorer en communication française et en compétences du 21e siècle.',
                    ],
                    [
                        'key' => 'flexibility',
                        'title' => 'Flexibilité et Commodité',
                        'body' => 'Détendez-vous en sachant que les cours en ligne s\'adaptent à votre emploi du temps, peuvent être ajustés pour les changements de dernière minute et rendent l\'apprentissage sans stress.',
                    ],
                ],
            ],
            'pricing' => [
                'title' => 'Tarifs',
                'subtitle' => 'Cours de français en ligne, niveaux K à 12.',
                'currency' => null,
                'packages' => [
                    [
                        'name' => 'Formule Tartelette',
                        'details' => [
                            'Niveaux K-12',
                            'Formation 1-à-1 35$ par heure',
                        ],
                    ],
                    [
                        'name' => 'Formule Macaron',
                        'details' => [
                            'Niveaux K-12',
                            'Formation 1-à-1 8 heures pour 240$ — 30$ par heure',
                        ],
                    ],
                    [
                        'name' => 'Formule Croissant',
                        'details' => [
                            'Niveaux 1-12',
                            'Cours de conversation en groupe pour débutants',
                            '2 heures pour 50$',
                            'Dates : (À déterminer)',
                        ],
                    ],
                ],
            ],
            'stats' => [
                'items' => [
                    ['value' => '4 000+', 'lang_key' => 'label_hours'],
                    ['value' => 'K–12',   'lang_key' => 'label_grades'],
                    ['value' => '100%',   'lang_key' => 'label_online'],
                    ['value' => '5★',     'lang_key' => 'label_rating'],
                ],
            ],
            'programs' => [
                'title' => 'Programmes pour tous les niveaux',
                'items' => [
                    [
                        'title'  => 'Débutant',
                        'grades' => 'Maternelle – 3e année',
                        'body'   => 'Une introduction ludique et immersive au français — alphabet, couleurs, nombres, salutations et phrases simples dans un environnement amusant et sans stress.',
                        'tags'   => ['Vocabulaire', 'Prononciation', 'Phonétique', 'Chansons et Jeux'],
                    ],
                    [
                        'title'  => 'Intermédiaire',
                        'grades' => '4e année – 8e année',
                        'body'   => 'Grammaire structurée, compréhension de lecture et expression orale pour aider les élèves à développer leur aisance et exceller dans les programmes scolaires de français.',
                        'tags'   => ['Grammaire', 'Lecture', 'Écriture', 'Compétences orales'],
                    ],
                    [
                        'title'  => 'Avancé',
                        'grades' => '9e année – 12e année',
                        'body'   => 'Préparation ciblée aux examens du secondaire et aux évaluations provinciales, avec un accent sur la rédaction de dissertations, l\'analyse littéraire et la conversation avancée.',
                        'tags'   => ['Préparation aux examens', 'Rédaction', 'Littérature', 'Débat'],
                    ],
                ],
            ],
            'testimonials' => [
                'title' => 'Ce que disent les familles',
                'items' => [
                    [
                        'name'   => 'Sarah M.',
                        'role'   => 'Parent d\'un élève de 5e année',
                        'rating' => 5,
                        'body'   => 'Naima est absolument merveilleuse ! Ma fille est passée de la crainte du cours de français à l\'attente de chaque leçon. Ses notes se sont considérablement améliorées en deux mois.',
                    ],
                    [
                        'name'   => 'James T.',
                        'role'   => 'Parent d\'un élève de 10e année',
                        'rating' => 5,
                        'body'   => 'L\'approche personnalisée a fait toute la différence. Naima a identifié exactement où mon fils avait des difficultés et a créé un plan qui a fonctionné. Il a réussi son examen provincial haut la main.',
                    ],
                    [
                        'name'   => 'Priya K.',
                        'role'   => 'Parent d\'un élève de 2e année',
                        'rating' => 5,
                        'body'   => 'Naima est formidable ! Les leçons sont claires, personnalisées et motivantes. Mon enfant est toujours enthousiaste d\'apprendre de nouveaux mots et chansons en français.',
                    ],
                    [
                        'name'   => 'Marc D.',
                        'role'   => 'Élève de 12e année',
                        'rating' => 5,
                        'body'   => 'J\'étais complètement perdu dans mon cours de français et Naima m\'a aidé à me remettre sur les rails rapidement. Son style d\'enseignement est patient et super clair. Meilleur investissement avant mes examens finaux.',
                    ],
                    [
                        'name'   => 'Linda C.',
                        'role'   => 'Parent d\'un élève de 7e année',
                        'rating' => 5,
                        'body'   => 'Horaires flexibles et qualité exceptionnelle. Naima s\'adapte à notre emploi du temps chargé et vient toujours préparée avec des activités engageantes. Je recommande vivement !',
                    ],
                    [
                        'name'   => 'Aisha R.',
                        'role'   => 'Parent de deux élèves',
                        'rating' => 5,
                        'body'   => 'Mes deux enfants ont des cours avec Naima et les résultats ont été remarquables pour tous les deux, même s\'ils sont à des niveaux très différents. Elle s\'adapte si bien.',
                    ],
                ],
            ],
            'resources' => [
                'title' => 'Ressources d\'apprentissage gratuites',
                'items' => [],
            ],
            'faq' => [
                'title' => 'FAQ',
                'items' => [
                    [
                        'q' => 'Qu\'est-ce que la méthode FrenchBoost ?',
                        'a' => "Ce cadre se concentre sur les besoins et les forces de chaque élève. Il encourage des objectifs clairs, des habitudes d'apprentissage positives et une expérience d'apprentissage engageante qui aide les élèves à devenir des locuteurs français confiants tout en développant leur réussite à l'école et au-delà.",
                    ],
                    [
                        'q' => 'Pourquoi êtes-vous devenue professeure de français ?',
                        'a' => "J'aime apprendre et partager la joie et les opportunités qui viennent avec l'apprentissage d'une nouvelle langue. Une langue devient encore plus intéressante lorsqu'elle est liée à la culture, à la nourriture, aux expressions idiomatiques et à l'histoire. Enseigner une nouvelle langue est une véritable passion pour moi.",
                    ],
                    [
                        'q' => 'Comment les séances sont-elles organisées ?',
                        'a' => 'Nous travaillerons ensemble pour trouver une date qui convient à tous les deux, donc je ferai de mon mieux pour m\'adapter à votre emploi du temps.',
                    ],
                    [
                        'q' => 'Où nous retrouverons-nous pour notre cours en ligne ?',
                        'a' => 'J\'utiliserai Google Meet ou Zoom pour les séances.',
                    ],
                    [
                        'q' => 'À quoi ressemblera ma première leçon ?',
                        'a' => 'Je créerai un plan personnalisé basé sur vos besoins et objectifs. Tout au long du cours, j\'utiliserai une variété d\'outils pour vous garder engagé et motivé vers l\'atteinte de vos objectifs.',
                    ],
                    [
                        'q' => 'Comment puis-je payer ?',
                        'a' => 'Les paiements peuvent être effectués par virement bancaire après chaque leçon. Pour les forfaits, le paiement doit être effectué avant le début du cours.',
                    ],
                    [
                        'q' => 'Quelle est la procédure si j\'annule un cours ?',
                        'a' => 'Je comprends que des événements imprévus comme la maladie peuvent survenir. Cependant, si vous allez manquer une séance ou devez la reprogrammer, veuillez me prévenir au moins 24h à l\'avance. Sinon, vous serez facturé le montant total. Merci de votre compréhension et coopération.',
                    ],
                    [
                        'q' => 'Quelle est votre citation préférée ?',
                        'a' => '"Cela semble toujours impossible jusqu\'à ce que ce soit fait." — Nelson Mandela',
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
