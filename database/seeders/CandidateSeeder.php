<?php

namespace Database\Seeders;

use App\Models\Candidate;
use App\Models\Election;
use Illuminate\Database\Seeder;

class CandidateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create a sample election first (or use an existing one)
        $election = Election::firstOrCreate(
            ['title' => 'General Election 2025'],
            [
                'is_open' => true,
            ]
        );

        // Define candidates with different positions and party lists (20+ party lists)
        $candidates = [
            // President
            [
                'election_id' => $election->id,
                'name' => 'John Smith',
                'position' => 'President',
                'party' => 'Progressive Party',
            ],
            [
                'election_id' => $election->id,
                'name' => 'Maria Garcia',
                'position' => 'President',
                'party' => 'Unity Alliance',
            ],
            [
                'election_id' => $election->id,
                'name' => 'Robert Anderson',
                'position' => 'President',
                'party' => 'Democratic League',
            ],
            [
                'election_id' => $election->id,
                'name' => 'Sophia Williams',
                'position' => 'President',
                'party' => 'Future Vision Coalition',
            ],
            
            // Vice President
            [
                'election_id' => $election->id,
                'name' => 'David Chen',
                'position' => 'Vice President',
                'party' => 'Progressive Party',
            ],
            [
                'election_id' => $election->id,
                'name' => 'Sarah Johnson',
                'position' => 'Vice President',
                'party' => 'Unity Alliance',
            ],
            [
                'election_id' => $election->id,
                'name' => 'Jennifer Martinez',
                'position' => 'Vice President',
                'party' => 'Student Empowerment Movement',
            ],
            [
                'election_id' => $election->id,
                'name' => 'Alexander Torres',
                'position' => 'Vice President',
                'party' => 'Innovation Front',
            ],
            
            // Secretary
            [
                'election_id' => $election->id,
                'name' => 'Michael Brown',
                'position' => 'Secretary',
                'party' => 'Progressive Party',
            ],
            [
                'election_id' => $election->id,
                'name' => 'Amanda Taylor',
                'position' => 'Secretary',
                'party' => 'Citizens United Party',
            ],
            [
                'election_id' => $election->id,
                'name' => 'Daniel Lee',
                'position' => 'Secretary',
                'party' => 'Reform Coalition',
            ],
            [
                'election_id' => $election->id,
                'name' => 'Olivia Rodriguez',
                'position' => 'Secretary',
                'party' => 'Green Initiative Party',
            ],
            
            // Treasurer
            [
                'election_id' => $election->id,
                'name' => 'Emily Davis',
                'position' => 'Treasurer',
                'party' => 'Unity Alliance',
            ],
            [
                'election_id' => $election->id,
                'name' => 'Christopher White',
                'position' => 'Treasurer',
                'party' => 'Equality First Party',
            ],
            [
                'election_id' => $election->id,
                'name' => 'Lisa Thompson',
                'position' => 'Treasurer',
                'party' => 'Liberal Democratic Alliance',
            ],
            [
                'election_id' => $election->id,
                'name' => 'Brandon Mitchell',
                'position' => 'Treasurer',
                'party' => 'People\'s Choice Movement',
            ],
            
            // Auditor
            [
                'election_id' => $election->id,
                'name' => 'James Wilson',
                'position' => 'Auditor',
                'party' => 'Independent',
            ],
            [
                'election_id' => $election->id,
                'name' => 'Patricia Moore',
                'position' => 'Auditor',
                'party' => 'Transparency Alliance',
            ],
            [
                'election_id' => $election->id,
                'name' => 'Thomas Harris',
                'position' => 'Auditor',
                'party' => 'Accountability Party',
            ],
            [
                'election_id' => $election->id,
                'name' => 'Victoria Campbell',
                'position' => 'Auditor',
                'party' => 'Justice League Party',
            ],
            
            // Public Relations Officer
            [
                'election_id' => $election->id,
                'name' => 'Jessica Robinson',
                'position' => 'Public Relations Officer',
                'party' => 'Progressive Party',
            ],
            [
                'election_id' => $election->id,
                'name' => 'Brian Clark',
                'position' => 'Public Relations Officer',
                'party' => 'Social Progress Party',
            ],
            [
                'election_id' => $election->id,
                'name' => 'Michelle Lewis',
                'position' => 'Public Relations Officer',
                'party' => 'Youth Action Front',
            ],
            [
                'election_id' => $election->id,
                'name' => 'Nathan Phillips',
                'position' => 'Public Relations Officer',
                'party' => 'Community First Coalition',
            ],
            
            // Business Manager
            [
                'election_id' => $election->id,
                'name' => 'Kevin Walker',
                'position' => 'Business Manager',
                'party' => 'Unity Alliance',
            ],
            [
                'election_id' => $election->id,
                'name' => 'Angela Hall',
                'position' => 'Business Manager',
                'party' => 'Economic Development Party',
            ],
            [
                'election_id' => $election->id,
                'name' => 'Mark Young',
                'position' => 'Business Manager',
                'party' => 'Enterprise Alliance',
            ],
            [
                'election_id' => $election->id,
                'name' => 'Rebecca Stewart',
                'position' => 'Business Manager',
                'party' => 'Fiscal Responsibility Party',
            ],
            
            // Senator - District A
            [
                'election_id' => $election->id,
                'name' => 'Rachel Green',
                'position' => 'Senator - District A',
                'party' => 'Progressive Party',
            ],
            [
                'election_id' => $election->id,
                'name' => 'Steven King',
                'position' => 'Senator - District A',
                'party' => 'Unity Alliance',
            ],
            [
                'election_id' => $election->id,
                'name' => 'Melissa Cooper',
                'position' => 'Senator - District A',
                'party' => 'New Horizons Party',
            ],
            [
                'election_id' => $election->id,
                'name' => 'Gregory Bennett',
                'position' => 'Senator - District A',
                'party' => 'Freedom Coalition',
            ],
            
            // Senator - District B
            [
                'election_id' => $election->id,
                'name' => 'Laura Scott',
                'position' => 'Senator - District B',
                'party' => 'Unity Alliance',
            ],
            [
                'election_id' => $election->id,
                'name' => 'Ryan Baker',
                'position' => 'Senator - District B',
                'party' => 'Democratic League',
            ],
            [
                'election_id' => $election->id,
                'name' => 'Samantha Rivera',
                'position' => 'Senator - District B',
                'party' => 'Solidarity Movement',
            ],
            [
                'election_id' => $election->id,
                'name' => 'Tyler Morgan',
                'position' => 'Senator - District B',
                'party' => 'Progressive Reform Party',
            ],
            
            // Senator - District C
            [
                'election_id' => $election->id,
                'name' => 'Nicole Adams',
                'position' => 'Senator - District C',
                'party' => 'Progressive Party',
            ],
            [
                'election_id' => $election->id,
                'name' => 'Eric Nelson',
                'position' => 'Senator - District C',
                'party' => 'Independent',
            ],
            [
                'election_id' => $election->id,
                'name' => 'Christine Howard',
                'position' => 'Senator - District C',
                'party' => 'Change Now Coalition',
            ],
            [
                'election_id' => $election->id,
                'name' => 'Marcus Sullivan',
                'position' => 'Senator - District C',
                'party' => 'United Front Party',
            ],
        ];

        // Insert candidates
        foreach ($candidates as $candidate) {
            Candidate::create($candidate);
        }

        $this->command->info(count($candidates) . ' candidates have been seeded successfully!');
    }
}
