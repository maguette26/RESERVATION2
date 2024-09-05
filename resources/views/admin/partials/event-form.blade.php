<div class="mb-3">
    <label for="name" class="form-label">Nom</label>
    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $event->name ?? '') }}" placeholder="Nom de l'événement" required>
</div>

<div class="mb-3">
    <label for="description" class="form-label">Description</label>
    <textarea class="form-control" id="description" name="description" placeholder="Description de l'événement" rows="3" required>{{ old('description', $event->description ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label for="date" class="form-label">Date</label>
    <input type="date" class="form-control" id="date" name="date" value="{{ old('date', $event->date ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="lieu" class="form-label">Lieu</label>
    <input type="text" class="form-control" id="lieu" name="lieu" value="{{ old('lieu', $event->lieu ?? '') }}" placeholder="Lieu de l'événement" required>
</div>

<div class="mb-3">
    <label for="nombre_place" class="form-label">Nombre de places</label>
    <input type="number" class="form-control" id="nombre_place" name="nombre_place" value="{{ old('nombre_place', $event->nombre_place ?? '') }}" placeholder="Nombre de places disponibles" required>
</div>

<div class="mb-3">
    <label for="heure" class="form-label">Heure</label>
    <input type="time" class="form-control" id="heure" name="heure" value="{{ old('heure', $event->heure ?? '') }}" placeholder="Heure de l'événement" required>
</div>

<div class="mb-3">
    <label for="image" class="form-label">Image</label>
    <input type="file" class="form-control" id="image" name="image">
    @isset($event->image)
        <img src="{{ asset($event->image) }}" alt="Image actuelle" class="img-thumbnail mt-2" style="max-width: 200px;">
    @endisset
</div>

<div class="mb-3">
    <label for="categorie" class="form-label">Catégorie</label>
    <select id="categorie" name="event_type_id" class="form-select" required>
        @foreach ($eventTypes as $type)
            <option value="{{ $type->id }}" {{ $type->id == ($event->event_type_id ?? '') ? 'selected' : '' }}>
                {{ $type->categorie }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-4">
    <label for="prix" class="form-label">Prix</label>
    <input id="prix" type="text" class="form-control" name="prix" value="{{ old('prix', $event->prix ?? '') }}" placeholder="Prix de l'événement" required>
</div>
