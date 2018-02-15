<?php

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */



Auth::routes();

Route::get('/', 'PagesController@getLanding');

Route::get('/dashboard', 'PagesController@getDashboard');

Route::patch('/users/{user}/update/photo', 'UsersController@updatePhoto');

Route::resource('tournaments', 'TournamentsController');


Route::prefix('admin')->namespace('Admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', 'PagesController@getDashboard');
    Route::resource('users', 'UsersController');
    Route::resource('players', 'PlayersController');
    Route::resource('referees', 'RefereesController');
    Route::resource('teams', 'TeamsController');
    Route::resource('venues', 'VenuesController');
    Route::patch('matches/{match}/upload/results', 'MatchesController@uploadResults');
    Route::resource('matches', 'MatchesController');

    Route::get('/tournaments/{tournament}/teams/edit', 'TournamentsController@editTeams');
    Route::patch('/tournaments/{tournament}/teams/update', 'TournamentsController@updateTeams');
    Route::get('/tournaments/{tournament}/schedule/randomizeteams', 'TournamentsController@getRandomizeFirstRoundTeams');
    Route::get('/tournaments/{tournament}/schedule/edit', 'TournamentsController@editSchedule');
    Route::patch('/tournaments/{tournament}/schedule/update', 'TournamentsController@updateSchedule');
    Route::get('/tournaments/{tournament}/matches', 'TournamentsController@getMatches');
    Route::resource('tournaments', 'TournamentsController');
});
