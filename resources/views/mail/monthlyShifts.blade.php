<ul>
    <span style="display: none">{{$duration=0}}</span>
    @foreach($shifts as $shift)
        <li>From: {{$shift['start']}} To: {{$shift['end']}} -> duration {{$shift['duration']}}</li>
        <span style="display: none">{{$duration = $duration + $shift['duration']}}</span>
    @endforeach
</ul>
Total hours: {{$duration}}