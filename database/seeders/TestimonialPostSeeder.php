<?php

namespace Database\Seeders;

use App\Models\TestimonialPost;
use App\Models\User;
use Illuminate\Database\Seeder;

class TestimonialPostSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('is_admin', true)->first();

        if (!$admin) {
            $this->command->warn('No admin user found. Skipping testimonial seeder.');
            return;
        }

        $testimonials = [
            [
                'locale' => 'en',
                'name' => 'Sarah M.',
                'role' => 'Parent of a Grade 5 student',
                'rating' => 5,
                'body' => 'Naima is absolutely wonderful! My daughter went from dreading French class to looking forward to every lesson. Her grades improved significantly within two months.',
            ],
            [
                'locale' => 'en',
                'name' => 'James T.',
                'role' => 'Parent of a Grade 10 student',
                'rating' => 5,
                'body' => 'The personalized approach made all the difference. Naima identified exactly where my son was struggling and created a plan that worked. He passed his provincial exam with flying colours.',
            ],
            [
                'locale' => 'en',
                'name' => 'Priya K.',
                'role' => 'Parent of a Grade 2 student',
                'rating' => 5,
                'body' => 'Naima is great! The lessons are clear, personalized, and motivating. My child is always excited to learn new French words and songs.',
            ],
            [
                'locale' => 'en',
                'name' => 'Marc D.',
                'role' => 'Grade 12 student',
                'rating' => 5,
                'body' => 'I was completely lost in my French class and Naima helped me get back on track fast. Her teaching style is patient and super clear. Best investment before my finals.',
            ],
            [
                'locale' => 'en',
                'name' => 'Linda C.',
                'role' => 'Parent of a Grade 7 student',
                'rating' => 5,
                'body' => 'Flexible scheduling and outstanding quality. Naima accommodates our busy schedule and always comes prepared with engaging activities. Highly recommend!',
            ],
            [
                'locale' => 'en',
                'name' => 'Aisha R.',
                'role' => 'Parent of two students',
                'rating' => 5,
                'body' => 'Both of my children have lessons with Naima and the results have been remarkable for both of them, even though they are at very different levels. She adapts so well.',
            ],

            // French
            [
                'locale' => 'fr',
                'name' => 'Sarah M.',
                'role' => 'Maman d’une élève de 5e année',
                'rating' => 5,
                'body' => 'Naima est absolument formidable ! Ma fille est passée de redouter ses cours de français à attendre chaque leçon avec impatience. Ses notes se sont nettement améliorées en seulement deux mois.',
            ],
            [
                'locale' => 'fr',
                'name' => 'James T.',
                'role' => 'Papa d’un élève de 10e année',
                'rating' => 5,
                'body' => 'L’approche personnalisée a tout changé. Naima a identifié exactement où mon fils avait des difficultés et a créé un plan qui a vraiment fonctionné. Il a réussi son examen provincial avec d’excellents résultats.',
            ],
            [
                'locale' => 'fr',
                'name' => 'Priya K.',
                'role' => 'Maman d’une élève de 2e année',
                'rating' => 5,
                'body' => 'Naima est géniale ! Les leçons sont claires, adaptées et motivantes. Mon enfant est toujours enthousiaste à l’idée d’apprendre de nouveaux mots et chansons en français.',
            ],
            [
                'locale' => 'fr',
                'name' => 'Marc D.',
                'role' => 'Élève de 12e année',
                'rating' => 5,
                'body' => 'J’étais complètement perdu dans mon cours de français et Naima m’a aidé à me remettre sur la bonne voie très rapidement. Sa façon d’expliquer est patiente et super claire. Le meilleur investissement avant mes examens finaux.',
            ],
            [
                'locale' => 'fr',
                'name' => 'Linda C.',
                'role' => 'Maman d’un élève de 7e année',
                'rating' => 5,
                'body' => 'Horaire flexible et qualité exceptionnelle. Naima s’adapte à notre emploi du temps chargé et arrive toujours avec des activités engageantes. Je la recommande vivement !',
            ],
            [
                'locale' => 'fr',
                'name' => 'Aisha R.',
                'role' => 'Maman de deux élèves',
                'rating' => 5,
                'body' => 'Mes deux enfants prennent des cours avec Naima et les résultats sont remarquables pour chacun d’eux, même s’ils sont à des niveaux très différents. Elle s’adapte incroyablement bien.',
            ],
        ];

        foreach ($testimonials as $index => $testimonial) {
            TestimonialPost::firstOrCreate([
                'user_id' => $admin->id,
                'locale' => $testimonial['locale'],
                'name' => $testimonial['name'],
                'role' => $testimonial['role'],
                'body' => $testimonial['body'],
                'rating' => $testimonial['rating'],
                'is_visible' => true,
                'display_order' => $index,
            ]);
        }

        $this->command->info('Created ' . count($testimonials));
    }
}
