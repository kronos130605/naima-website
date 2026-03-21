<?php

namespace Database\Seeders;

use App\Models\MindMap;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MindMapSeeder extends Seeder
{
    public function run(): void
    {
        $maps = [
            ['group' => 'maternelle', 'level' => 'Maternelle', 'topic_en' => 'Reading',     'topic_fr' => 'Lecture',       'title_en' => 'The Alphabet',         'title_fr' => "L'Alphabet",              'description_en' => 'Visual mind map of all 26 letters with example words.',           'description_fr' => 'Carte mentale visuelle des 26 lettres avec mots exemples.'],
            ['group' => 'maternelle', 'level' => 'Maternelle', 'topic_en' => 'Vocabulary',  'topic_fr' => 'Vocabulaire',   'title_en' => 'Colours & Shapes',      'title_fr' => 'Couleurs & Formes',       'description_en' => 'Learn colours and basic shapes with pictures.',                  'description_fr' => 'Apprendre les couleurs et les formes avec des images.'],
            ['group' => 'primaire',   'level' => 'CP',         'topic_en' => 'Phonics',     'topic_fr' => 'Phonétique',    'title_en' => 'Vowel Sounds',          'title_fr' => 'Les Sons des Voyelles',   'description_en' => 'All vowel sounds and their combinations.',                       'description_fr' => 'Tous les sons vocaliques et leurs combinaisons.'],
            ['group' => 'primaire',   'level' => 'CP',         'topic_en' => 'Reading',     'topic_fr' => 'Lecture',       'title_en' => 'Syllables',             'title_fr' => 'Les Syllabes',            'description_en' => 'How to break words into syllables.',                             'description_fr' => 'Comment découper les mots en syllabes.'],
            ['group' => 'primaire',   'level' => 'CE1',        'topic_en' => 'Grammar',     'topic_fr' => 'Grammaire',     'title_en' => 'Present: être & avoir', 'title_fr' => 'Présent : être & avoir', 'description_en' => 'Conjugation of être and avoir in the present tense.',           'description_fr' => 'Conjugaison de être et avoir au présent.'],
            ['group' => 'primaire',   'level' => 'CE1',        'topic_en' => 'Grammar',     'topic_fr' => 'Grammaire',     'title_en' => 'Nouns & Articles',      'title_fr' => 'Noms & Déterminants',    'description_en' => 'Masculine, feminine, singular and plural.',                      'description_fr' => 'Masculin, féminin, singulier et pluriel.'],
            ['group' => 'primaire',   'level' => 'CE2',        'topic_en' => 'Conjugation', 'topic_fr' => 'Conjugaison',   'title_en' => '1st Group Verbs',       'title_fr' => 'Verbes du 1er groupe',   'description_en' => 'All endings for -er verbs in the present tense.',               'description_fr' => 'Toutes les terminaisons des verbes en -er au présent.'],
            ['group' => 'primaire',   'level' => 'CE2',        'topic_en' => 'Grammar',     'topic_fr' => 'Grammaire',     'title_en' => 'Adjective Agreement',   'title_fr' => "Accord de l'Adjectif",   'description_en' => 'Rules for adjective agreement in gender and number.',            'description_fr' => "Règles d'accord de l'adjectif en genre et en nombre."],
            ['group' => 'primaire',   'level' => 'CM1',        'topic_en' => 'Conjugation', 'topic_fr' => 'Conjugaison',   'title_en' => 'Passé Composé',         'title_fr' => 'Le Passé Composé',       'description_en' => 'Formation with avoir and être auxiliaries.',                     'description_fr' => 'Formation avec les auxiliaires avoir et être.'],
            ['group' => 'primaire',   'level' => 'CM1',        'topic_en' => 'Grammar',     'topic_fr' => 'Grammaire',     'title_en' => 'Types of Sentences',    'title_fr' => 'Types de Phrases',       'description_en' => 'Declarative, interrogative, exclamatory, imperative.',           'description_fr' => 'Déclarative, interrogative, exclamative, impérative.'],
            ['group' => 'primaire',   'level' => 'CM2',        'topic_en' => 'Conjugation', 'topic_fr' => 'Conjugaison',   'title_en' => "L'Imparfait",           'title_fr' => "L'Imparfait",            'description_en' => 'Imparfait endings for all verb groups.',                        'description_fr' => "Terminaisons de l'imparfait pour tous les groupes."],
            ['group' => 'primaire',   'level' => 'CM2',        'topic_en' => 'Writing',     'topic_fr' => 'Écriture',      'title_en' => 'Punctuation',           'title_fr' => 'La Ponctuation',         'description_en' => 'All punctuation marks and their uses.',                          'description_fr' => 'Tous les signes de ponctuation et leurs usages.'],
            ['group' => 'college',    'level' => '6ème',       'topic_en' => 'Conjugation', 'topic_fr' => 'Conjugaison',   'title_en' => 'Futur Simple',          'title_fr' => 'Le Futur Simple',        'description_en' => 'Future tense for regular and irregular verbs.',                 'description_fr' => 'Futur simple pour les verbes réguliers et irréguliers.'],
            ['group' => 'college',    'level' => '4ème',       'topic_en' => 'Conjugation', 'topic_fr' => 'Conjugaison',   'title_en' => 'Subjonctif Présent',    'title_fr' => 'Le Subjonctif Présent',  'description_en' => 'Uses and conjugation of the subjunctive mood.',                 'description_fr' => 'Emplois et conjugaison du subjonctif présent.'],
            ['group' => 'lycee',      'level' => '2nde',       'topic_en' => 'Conjugation', 'topic_fr' => 'Conjugaison',   'title_en' => 'Le Conditionnel',       'title_fr' => 'Le Conditionnel',        'description_en' => 'Present and past conditional forms and uses.',                   'description_fr' => 'Conditionnel présent et passé : formes et emplois.'],
            ['group' => 'lycee',      'level' => '1ère',       'topic_en' => 'Literature',  'topic_fr' => 'Littérature',   'title_en' => 'Figures of Speech',     'title_fr' => 'Figures de Style',       'description_en' => 'Key rhetorical figures with examples.',                          'description_fr' => 'Principales figures de style avec exemples.'],
        ];

        foreach ($maps as $i => $map) {
            MindMap::firstOrCreate(
                ['slug' => Str::slug($map['title_en'])],
                array_merge($map, [
                    'is_published' => false,
                    'sort_order'   => $i,
                ])
            );
        }
    }
}
