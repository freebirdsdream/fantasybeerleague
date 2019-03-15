<?php

use Illuminate\Database\Seeder;
use App\BeerStyle;

class CreateBeerStyles extends Seeder
{
    /**
     * Create Beer Styles
     * pulled from https://en.wikipedia.org/wiki/List_of_beer_styles
     *
     * @return void
     */
    public function run()
    {
        $styles = [
        	'Altbier' => ['German-Style Altbier'],
    		'Amber Ale' => ['American-Style Amber/Red Ale'],
    		'Barleywine' => ['British-Style Barley Wine Ale', 'American-Style Barley Wine Ale'],
    		'Berliner Weisse' => ['Berliner-Style Weisse'],
    		'Bière de Garde' => ['French-Style Bière de Garde'],
    		'Bitter' => ['Ordinary Bitter', 'Special or Best Bitter', 'Extra Special Bitter'],
    		'Blonde Ale' => ['Golden or Blonde Ale', 'Belgian-Style Blonde Ale'],
    		'Bock' => ['Traditional German-Style Bock'],
    		'Brown Ale' => ['English-Style Brown Ale', 'American-Style Brown Ale'],
    		'California Common/Steam Beer' => ['California Common Beer'],
    		'Cream Ale' => ['American-Style Cream Ale'],
    		'Dortmunder Export' => ['Dortmunder/European-Style Export'],
    		'Doppelbock' => ['German-Style Doppelbock'],
    		'Dunkel' => ['Münchner Dunkel', 'European-Style Dark Lager'],
    		'Dunkelweizen' => ['South German-Style Dunkel Weizen'],
    		'Eisbock' => ['German-Style Eisbock'],
    		'Flanders red ale' => ['Belgian-Style Flanders Oud Bruin or Oud Red Ale'],
    		'Golden/Summer ale' => ['English-Style Summer Ale', 'Golden or Blonde Ale'],
    		'Gose' => ['Leipzig-Style Gose', 'Contemporary Gose'],
    		'Gueuze' => ['Belgian-Style Gueuze Lambic'],
    		'Hefeweizen' => ['South German-Style Hefeweizen'],
    		'Helles' => ['Münchner (Munich)-Style Helles'],
    		'India pale ale' => ['English-Style India Pale Ale', 'American-Style India Pale Ale', 'Session India Pale Ale', 'Imperial or Double India Pale Ale'],
    		'Kölsch' => ['German-Style Kölsch'],
    		'Lambic' => ['Belgian-Style Lambic', 'Belgian-Style Fruit Lambic'],
    		'Light ale' => [],
    		'Maibock/Helles bock' => ['German-Style Heller Bock/Maibock'],
    		'Malt liquor' => ['American-Style Malt Liquor'],
    		'Mild' => ['English-Style Pale Mild Ale', 'English-Style Dark Mild Ale'],
    		'Oktoberfestbier/Märzenbier' => ['German-Style Maerzen', 'German-Style Oktoberfest/Wiesn'],
    		'Old ale' => ['Old Ale'],
    		'Oud bruin' => ['Belgian-Style Flanders Oud Bruin or Oud Red Ale'],
    		'Pale ale' => ['Classic English-Style Pale Ale', 'American-Style Pale Ale', 'American-Style Strong Pale Ale', 'Belgian-Style Pale Ale', 'Australian-Style Pale Ale', 'International-Style Pale Ale'],
    		'Pilsener/Pilsner/Pils' => ['German-Style Pilsener', 'Bohemian-Style Pilsener', 'American-Style Pilsener', 'International-Style Pilsener'],
    		'Porter' => ['Brown Porter', 'Robust Porter', 'American-Style Imperial Porter', 'Smoke Porter', 'Baltic-Style Porter'],
    		'Red ale' => ['Irish-Style Red Ale', 'American-Style Amber/Red Ale', 'Double Red Ale', 'Imperial Red Ale'],
    		'Roggenbier' => ['German-Style Rye Ale'],
    		'Saison' => ['Classic French & Belgian-Style Saison', 'Specialty Saison'],
    		'Scotch ale' => ['Scotch Ale'],
    		'Stout' => ['Sweet Stout or Cream Stout', 'Oatmeal Stout', 'British-Style Imperial Stout', 'Classic Irish-Style Dry Stout', 'Export-Style Stout', 'American-Style Stout', 'American-Style Imperial Stout'],
    		'Schwarzbier' => ['German-Style Schwarzbier'],
    		'Vienna lager' => ['Vienna-Style Lager'],
    		'Witbier' => ['Belgian-Style Witbier'],
    		'Weissbier' => ['South German-Style Kristal Weizen', 'German-Style Leichtes Weizen', 'South German-Style Bernsteinfarbenes Weizen'],
    		'Weizenbock' => ['South German-Style Weizenbock'],
    		'Fruit beer' => ['American-Style Fruit Beer', 'Fruit Wheat Beer', 'Belgian-Style Fruit Beer'],
    		'Herb and spiced beer' => ['Chili Pepper Beer', 'Chocolate or Cocoa Beer', 'Coffee Beer', 'Herb and Spice Beer'],
    		'Honey beer' => ['Specialty Honey Beer'],
    		'Rye Beer' => ['Rye Beer'],
    		'Smoked beer' => ['Smoke Beer'],
    		'Vegetable beer' => ['Field Beer', 'Pumpkin Spice Beer', 'Pumpkin/Squash Beer'],
    		'Wild beer' => ['Brett Beer', 'Mixed-Culture Brett Beer', 'Wild Beer'],
    		'Wood-aged beer' => ['Wood- and Barrel-Aged Beer', 'Wood- and Barrel-Aged Pale to Amber Beer', 'Wood- and Barrel-Aged Dark Beer', 'Wood- and Barrel-Aged Strong Beer', 'Wood- and Barrel-Aged Sour Beer']
        ];

        foreach($styles as $type => $brewers) {
            BeerStyle::create([
                'style' => $type,
                'brewers_association' => json_encode($brewers)
            ]);
        }
    }
}
