<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <!-- {{ date('Y') }}

    <br>

    {{ 3 + 7 }}

    <br>

    {!! "<h3>Hello</h3>" !!}

    <?= "<h3>Hello h</h3>" ?>

    <h2>
        Hello @{{ name }}
    </h2>

    @php
    $message = "Hello World123";
    @endphp

    <h2>{{ $message }}</h2>

    {{-- this is a comment --}} -->

    <div>
        <a href='{{ route('contacts.index') }}'>All contacts</a>
        <a href='{{ route('contacts.create') }}'>Add contacts</a>
        <a href='{{ route('contacts.show', 1) }}'>Show contacts</a>
    </div>
</body>

</html>