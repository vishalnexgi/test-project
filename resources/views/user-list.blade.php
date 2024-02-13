<style>
    table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
    }
</style>
<h1>Registered Users List</h1>
<br>
<table style="width:100%">
    <tr>
        <th>Sl. No.</th>
        <th>User Id</th>
        <th>Email</th>
    </tr>
    @foreach($users as $index => $user)
    <tr>
        <td> {{ $index+1 }} </td>
        <td> {{ $user->id }} </td>
        <td> {{ $user->email }} </td>
    </tr>
    @endforeach
</table>