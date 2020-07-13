<?php

use Illuminate\Database\Seeder;

class wahanaSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('wahana')->insert([
        	'nama_wahana' => 'Seawalker',
            'deskripsi_wahana' => '<p>Bali Seawalker is an underwater activity that offers everyone an opportunity to enjoy an underwater experience with the minimum of equipment. The ‘walks’ utilize a specially-designed helmet that is connected to oxygen tanks aboard a boat, providing participants with a constant flow of air to breathe underwater.</p>

                <p>Participants with prescription lenses need not take their glasses off to enjoy the activity due to the convenient helmets, and will remain dry from the chin up throughout the tour. Depths are approximately seven metres, where you will soon be able to observe colourful schools of fish, coral reefs and marine life. Bali Seawalker operates at two main sites; off Sanur and Tanjung Benoa.</p>
            ',
            'biaya_wahana' => 350000,
            'urlslug' => 'seawalker'
        ]);
        DB::table('wahana')->insert([
            'nama_wahana' => 'Parasailing',
            'deskripsi_wahana' => '<p>Parasailing, also known as parascending or parakiting, is a recreational kiting activity where a person is towed behind a vehicle (usually a boat) while attached to a specially designed canopy wing that resembles a parachute, known as a parasail wing. The manned kite moving anchor may be a car, truck, or boat</p>

                <p>The harness attaches the pilot to the parasail, which is connected to the boat, or land vehicle, by the tow rope. The vehicle then drives off, carrying the parascender (or wing) and person into the air. If the boat is powerful enough, two or three people can parasail behind it at the same time. The parascender has little or no control over the parachute. The activity is primarily a fun ride, not to be confused with the sport of paragliding.</p>
            ',
            'biaya_wahana' => 350000,
            'urlslug' => 'parasailing'
        ]);
        DB::table('wahana')->insert([
            'nama_wahana' => 'Banana Boat',
            'deskripsi_wahana' => '<p>Banana Boat is a Polish a cappella sextet, authoring and performing original songs representing the genre of neo-shanties. Being one of the pioneers of the new genre, the group retains its simultaneous focus on contemporary interpretations of traditional sea shanties and maritime music.</p>

                 <p>Owing to its characteristic six-part, jazzy harmony, departing from the traditional sound of the music of the sea, the group has become one of the emblems of what the international artists of the maritime stage have informally come to dub as the Polish style[2] maritime song. With maritime music constantly in the focus of its activity, since 2004, Banana Boat has also been experimenting with other musical genres, including popular and jazz compositions, inviting other artists to participate in individual projects. The group is a Member of International Seasong and Shanty Association (ISSA)</p>
            ',
            'biaya_wahana' => 350000,
            'urlslug' => 'banana-boat'
        ]);               
        DB::table('wahana')->insert([
            'nama_wahana' => 'Wakeboarding',
            'deskripsi_wahana' => '<p>Wakeboarding is a towed surface water sport or leisure activity where a participant is towed on a small board behind a motorboat over a body of water. The participant rides wake produced by the towing boat, and attempts to do tricks.</p>
                <p>Environmental impact includes noise, pollutants, shoreline degradation, and disturbance and dislocation of wildlife,[1] and the governing body, the International Waterski & Wakeboard Federation (IWWF) has been acting to reduce this impact. The IWWF also governs the related sports of barefoot skiing, cable skiing, cable wakeboard, disabled ski, racing, show ski, water skiing, and wakesurfing.</p>
            ',
            'biaya_wahana' => 350000,
            'urlslug' => 'banana-boat'
        ]);                        
    }
}
