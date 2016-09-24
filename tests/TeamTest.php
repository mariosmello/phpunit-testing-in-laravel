<?php

use App\Team;
use App\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TeamTest extends TestCase
{

    use DatabaseTransactions;

    /** @test */
    public function a_team_has_a_name()
    {
        $team = new Team(['name' => 'Acme']);

        $this->assertEquals('Acme', $team->name);
    }

    /** @test */
    public function a_team_can_add_members()
    {
        $team = factory(Team::class)->create();

        $user = factory(User::class)->create();
        $user2 = factory(User::class)->create();

        $team->add($user);
        $team->add($user2);

        $this->assertEquals(2, $team->count());
    }

    /** @test */
    public function a_team_has_a_maximum_size()
    {
        $team = factory(Team::class)->create(['size' => 2]);

        $userOne = factory(User::class)->create();
        $userTwo = factory(User::class)->create();

        $team->add($userOne);
        $team->add($userTwo);

        $this->assertEquals(2, $team->count());

        $this->setExpectedException('Exception');
        $userThree = factory(User::class)->create();
        $team->add($userThree);
    }

    /** @test */
    public function a_team_can_add_multiple_members_at_once()
    {
        $team = factory(Team::class)->create(['size' => 10]);
        $users = factory(User::class, 10)->create();

        $team->add($users);

        $this->assertEquals(10, $team->count());


        $team = factory(Team::class)->create(['size' => 10]);
        $users = factory(User::class, 11)->create();

        $this->setExpectedException('Exception');
        $team->add($users);
    }

}
