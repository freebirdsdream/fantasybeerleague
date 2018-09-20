<div class="container mx-auto border border-orange-light border-solid bg-white rounded mt-8">
    <table>
        <thead class="w-full">
            <tr class="text-orange bg-orange-lightest border-orange-light border-b-2">
                <th class="p-4 w-3/5">Person / Beer</th>
                @foreach($tastingGroup->players as $player)
                    <th class="p-4">{{ $player->name }}</th>
                @endforeach
                <th class="p-4">Event Score</th>
                <th class="p-4">Event Rank</th>
                <th class="p-4">Total Score</th>
                <th class="p-4">Rank</th>
            </tr>
        </thead>
        <tbody class="w-full">
        @foreach($scores as $rank => $score)
            <?php $beer = $score->first()->beer; ?>
            <tr class="border-orange-light @if(!$loop->last) border-b @endif">
                <td class="p-4">{{ $beer->player->first()->name() }}: {{ $beer->brewery->name }} {{ $beer->name }}</td>
                @foreach($scores[$rank] as $person)
                    <td class="p-4 text-right">{{ $person->rating }}</td>
                @endforeach
                <td class="p-4 text-right">{{ $scores[$rank]->sum('rating') }}</td>
                <td class="p-4 text-right">{{ $rank + 1 }}</td>
                <td class="p-4 text-right">{{ $beer->player->first()->score() }}</td>
                <td class="p-4 text-right">{{ $beer->player->first()->rank() }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>