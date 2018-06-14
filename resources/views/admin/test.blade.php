
<p> {{$list}} </p>

<table>
    <tr>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    @foreach($test as $c)
        <tr>
            <td>{{$c->ID}}</td>
            <td>{{$c->Point}}</td>
            <td>{{$c->Strain}}</td>
        </tr>
    @endforeach
</table>