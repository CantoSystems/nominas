<form action="{{ route('f.data') }}" method="POST">
    @csrf
    <input type="text" placeholder="Días del periodo" name="dias">
    <br>
    <input type="date" placeholder="Inicio del periodo" name="fecha">
    <br>
    <input type="submit" value="Guardar">
</form>