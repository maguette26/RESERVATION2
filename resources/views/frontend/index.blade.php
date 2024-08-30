<!DOCTYPE html>
<html>
<head>
    <title>Liste des Événements</title>
</head>
<body>
    <h1>Événements disponibles</h1>
    <ul>
        @foreach ($events as $event)
        <tr>
            <td>{{ $event->name }}</td>
            <td>{{ $event->date }}</td>
            <td>{{ $event->nombre_place }}</td>
            <td>{{ $event->heure }}</td>
            <td>{{ $event->lieu }}</td>
            <td>{{ $event->description }}</td>
            <td>{{ $event->prix }}</td>
            <td>{{ $event->categorie }}</td>
            <td><img src="{{ asset($event->image)}}" alt="{{$event->nom}}" width="200"></td>
            <td>
            </tr>
        @endforeach
    </ul>
</body>
</html>
''
