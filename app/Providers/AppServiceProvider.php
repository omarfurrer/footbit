<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider {

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // CUSTOM VALIDATORS

        Validator::extend('required_if_attribute',
                          function($attribute, $value, $parameters, $validator) {
            $other = $parameters[0];
            $operator = $parameters[1];
            $criteria = $parameters[2];

            $data = $validator->getData();
            $otherValue = $data[$other];

            $required = false;

            switch ($operator) {

                case '==':
                    $required = $otherValue == $criteria;

                case '!=':
                    $required = $otherValue != $criteria;

                case '===':
                    $required = $otherValue === $criteria;

                case '!==':
                    $required = $otherValue !== $criteria;

                case '<':
                    $required = $otherValue < $criteria;

                case '<=':
                    $required = $otherValue <= $criteria;

                case '>':
                    $required = $otherValue > $criteria;

                case '>=':
                    $required = $otherValue >= $parameters[2];
            }

            return $required;
        });

        Validator::extend('greater_than_field',
                          function($attribute, $value, $parameters, $validator) {
            $min_field = $parameters[0];
            $data = $validator->getData();
            $min_value = $data[$min_field];
            return $value > $min_value;
        });

        Validator::extend('less_than_field',
                          function($attribute, $value, $parameters, $validator) {
            $max_field = $parameters[0];
            $data = $validator->getData();
            $max_value = $data[$max_field];
            return $value < $max_value;
        });

        Validator::replacer('greater_than_field', function ($message, $attribute, $rule, $parameters) {
            return str_replace([':other',], [$parameters[0]], $message);
        });

        Validator::replacer('less_than_field', function ($message, $attribute, $rule, $parameters) {
            return str_replace([':other',], [$parameters[0]], $message);
        });

        // CUSTOM DIRECTIVES

        Blade::directive('tournamenttype', function ($expression) {
            return "<?php echo BladeHelper::displayTournamentType($expression); ?>";
        });
        Blade::directive('tournamentstatus', function ($expression) {
            return "<?php echo BladeHelper::displayTournamentStatus($expression); ?>";
        });
        Blade::directive('tournamentagegroup',
                         function ($expression) {
            list($minAge, $maxAge) = explode(',', str_replace(['(', ')', ' '], '', $expression));
            return "<?php echo BladeHelper::displayTournamentAgeGroup($minAge,$maxAge); ?>";
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

}
