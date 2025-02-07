<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use App\Entity\Tournaments;
use App\Entity\Matches;
use App\Entity\Teams;
use App\Entity\Players;
use App\Entity\Position;
use App\Entity\Results;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Créer un générateur Faker
        $faker = Factory::create();
        $faker->unique()->numberBetween(1, 100);  // Assurer l'unicité

        // Créer 3 positions
        $positions = [];
        for ($i = 0; $i < 3; $i++) {
            $position = new Position();
            $position->setName($faker->word);
            $manager->persist($position);
            $positions[] = $position;
        }

        // Créer 10 utilisateurs
        $users = [];
        for ($i = 0; $i < 10; $i++) {
            $user = new User();
            $user->setEmail($faker->unique()->email);
            $user->setPassword(password_hash('password', PASSWORD_BCRYPT)); 
            $user->setRoles(['ROLE_USER']);
            $user->setFirstName($faker->firstName);
            $user->setLastName($faker->lastName);
            $user->setBirthDate($faker->dateTimeThisCentury);
            $user->setPosition($faker->randomElement($positions)); // Associer une position
            $manager->persist($user);
            $users[] = $user;
        }

        // Créer 5 équipes
        $teams = [];
        for ($i = 0; $i < 5; $i++) {
            $team = new Teams();
            $team->setName($faker->company);
            $team->setLogoUrl($faker->imageUrl());
            $manager->persist($team);
            $teams[] = $team;
        }

        // Créer 5 tournois
        $tournaments = [];
        for ($i = 0; $i < 5; $i++) {
            $tournament = new Tournaments();
            $tournament->setName($faker->word);
            $tournament->setStartDate($faker->dateTimeThisYear);
            $tournament->setEndDate($faker->dateTimeThisYear);
            $tournament->setMaxTeams(4);
            $tournament->setCreated($faker->dateTimeThisDecade);
            $tournament->setUpdated($faker->optional()->dateTimeThisDecade);
            $manager->persist($tournament);
            $tournaments[] = $tournament;
        }

        // Créer des matchs
        // $matches = [];
        // for ($i = 0; $i < 10; $i++) {
        //     $match = new Matches();
        //     $match->setTournamentId($faker->randomElement($tournaments));
        //     $match->setRound($faker->numberBetween(1, 5));
        //     $match->setTeam1Id($faker->randomElement($teams));
        //     $match->setTeam2Id($faker->randomElement($teams));
        //     $match->setTeam1Score($faker->numberBetween(0, 5));
        //     $match->setTeam2Score($faker->numberBetween(0, 5));
        //     $match->setMatchDate($faker->dateTimeThisYear);
        //     $manager->persist($match);
        //     $matches[] = $match;
        // }
        
        // Créer des matchs en assurant la liaison avec un tournoi
        $matches = [];
        foreach ($tournaments as $tournament) {
            // Chaque tournoi reçoit entre 2 et 5 matchs
            $matchCount = rand(2, 5);
            for ($i = 0; $i < $matchCount; $i++) {
                $match = new Matches();
                $match->setTournamentId($tournament); // Associer au tournoi

                // Éviter que Team1 soit la même que Team2
                do {
                    $team1 = $faker->randomElement($teams);
                    $team2 = $faker->randomElement($teams);
                } while ($team1 === $team2);

                $match->setTeam1Id($team1);
                $match->setTeam2Id($team2);
                $match->setRound($faker->numberBetween(1, 5));
                $match->setTeam1Score($faker->numberBetween(0, 5));
                $match->setTeam2Score($faker->numberBetween(0, 5));
                $match->setMatchDate($faker->dateTimeThisYear);
                $manager->persist($match);
                $matches[] = $match;
            }
        }

        // Créer des joueurs
        // for ($i = 0; $i < 10; $i++) {
        //     $player = new Players();
        //     $player->setUserId($faker->randomElement($users));
        //     $player->setTeamId($faker->randomElement($teams));
        //     $manager->persist($player);
        // }
        // Créer des joueurs
        // $usedUsers = []; // Stocker les utilisateurs déjà utilisés
        for ($i = 0; $i < 10; $i++) {
            $user = $users[$i] ?? null; // Assigner un utilisateur unique par joueur
            if (!$user) {
                break; // Si plus d'utilisateurs disponibles, arrêter
            }
            
            $player = new Players();
            $player->setUserId($user); // Chaque user est utilisé une seule fois
            $player->setTeamId($faker->randomElement($teams));
            $manager->persist($player);
        }


        // Créer des résultats
        for ($i = 0; $i < 5; $i++) {
            $result = new Results();
            $result->addMartchId($faker->randomElement($matches));
            $result->addWinnerTeam($faker->randomElement($teams));
            $manager->persist($result);
        }

        // Sauvegarder les objets dans la base de données
        $manager->flush();
    }
}
