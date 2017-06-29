<?php

use Illuminate\Database\Seeder;

class ValidateQuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $questions = [
            // Logistics
            [
                'project_type'      => 'Logistics',
                'rater_department'  => '7',
                'ratee_department'  => '5',
                'question'          => 'Did inventory team provide status of requested  materials to be prepared? (items for delivery coming from AAI warehouse)',
                'choices'           => [
                    [
                        'choice'    => 'Yes',
                        'point'     => 100
                    ],
                    [
                        'choice'    => 'Yes',
                        'point'     => 0
                    ]
                ]
            ],
            [
                'project_type'      => 'Logistics',
                'rater_department'  => '7',
                'ratee_department'  => '5',
                'question'          => 'Did inventory team provide shipment details?',
                'choices'           => [
                    [
                        'choice'    => 'Yes',
                        'point'     => 100
                    ],
                    [
                        'choice'    => 'Yes',
                        'point'     => 0
                    ]
                ]
            ],
            [
                'project_type'      => 'Logistics',
                'rater_department'  => '7',
                'ratee_department'  => '9',
                'question'          => 'Did Logistics team provide deployment plan of deliveries? (Delivery details - timings, clustering)',
                'choices'           => [
                    [
                        'choice'    => 'Yes',
                        'point'     => 100
                    ],
                    [
                        'choice'    => 'Yes',
                        'point'     => 0
                    ]
                ]
            ],
            [
                'project_type'      => 'Logistics',
                'rater_department'  => '5',
                'ratee_department'  => '7',
                'question'          => 'Did AE submit a formal request of preparation, pick-up or delivery?',
                'choices'           => [
                    [
                        'choice'    => 'Yes',
                        'point'     => 100
                    ],
                    [
                        'choice'    => 'Yes',
                        'point'     => 0
                    ]
                ]
            ],
            [
                'project_type'      => 'Logistics',
                'rater_department'  => '7',
                'ratee_department'  => '5',
                'question'          => 'Did AE provide complete pick-up and delivery details?',
                'choices'           => [
                    [
                        'choice'    => 'Yes, Complete on submitted JO',
                        'point'     => 80
                    ],
                    [
                        'choice'    => 'Yes, Incomplete - subject for follow-up',
                        'point'     => 20
                    ],
                    [
                        'choice'    => 'Yes',
                        'point'     => 0
                    ]
                ]
            ],
            [
                'project_type'      => 'Logistics',
                'rater_department'  => '7',
                'ratee_department'  => '9',
                'question'          => 'Did Logistics team provide deployment plan of deliveries? (Delivery details - timings, clustering)',
                'choices'           => [
                    [
                        'choice'    => 'Yes',
                        'point'     => 100
                    ],
                    [
                        'choice'    => 'Yes',
                        'point'     => 0
                    ]
                ]
            ]
        ];

        foreach ($questions as $question) {
            $choices = $question['choices'];
            unset($question['choices']);

            $question = \App\Models\ValidateQuestion::create($question);
            foreach ($choices as $choice) {
                $question->choices()->create($choice);
            }
        }
    }
}
