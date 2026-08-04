<?php

$entities = [
    [
        'name' => 'Category',
        'plural' => 'categories',
        'model' => 'ChurchCategory',
        'fields' => ['name' => 'text', 'slug' => 'text', 'description' => 'textarea', 'sort_order' => 'number', 'is_active' => 'checkbox']
    ],
    [
        'name' => 'Facility',
        'plural' => 'facilities',
        'model' => 'Facility',
        'fields' => ['name' => 'text', 'slug' => 'text', 'icon_name' => 'text']
    ],
    [
        'name' => 'Activity',
        'plural' => 'activities',
        'model' => 'Activity',
        'fields' => ['church_id' => 'number', 'title' => 'text', 'slug' => 'text', 'location_name' => 'text', 'start_at' => 'datetime-local', 'end_at' => 'datetime-local', 'is_active' => 'checkbox']
    ],
    [
        'name' => 'Announcement',
        'plural' => 'announcements',
        'model' => 'Announcement',
        'fields' => ['church_id' => 'number', 'title' => 'text', 'content' => 'textarea', 'priority' => 'text', 'starts_at' => 'datetime-local', 'ends_at' => 'datetime-local', 'is_active' => 'checkbox']
    ],
    [
        'name' => 'Article',
        'plural' => 'articles',
        'model' => 'Article',
        'fields' => ['title' => 'text', 'slug' => 'text', 'excerpt' => 'textarea', 'content' => 'textarea', 'status' => 'text', 'published_at' => 'datetime-local']
    ],
];

foreach ($entities as $e) {
    // 1. Controller
    $controllerName = $e['name'] . 'Controller';
    $modelName = $e['model'];
    $plural = $e['plural'];
    
    $validationRules = [];
    foreach ($e['fields'] as $field => $type) {
        if ($type === 'checkbox') continue;
        $validationRules[] = "'$field' => 'nullable'";
    }
    $validationStr = implode(",\n            ", $validationRules);

    $controllerCode = "<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\\$modelName;
use Illuminate\Http\Request;

class $controllerName extends Controller
{
    public function index() {
        \$data = $modelName::latest()->paginate(10);
        return view('admin.$plural.index', compact('data'));
    }

    public function create() {
        return view('admin.$plural.create');
    }

    public function store(Request \$request) {
        \$validated = \$request->validate([
            $validationStr
        ]);
        
        // Handle checkboxes
";
    foreach ($e['fields'] as $field => $type) {
        if ($type === 'checkbox') {
            $controllerCode .= "        \$validated['$field'] = \$request->has('$field');\n";
        }
    }
    
    // Auto set author_id for Article
    if ($e['model'] === 'Article') {
        $controllerCode .= "        \$validated['author_id'] = auth()->id();\n";
    }

    $controllerCode .= "
        $modelName::create(\$validated);
        return redirect('/admin/$plural')->with('success', '{$e['name']} created successfully.');
    }

    public function edit(\$id) {
        \$item = $modelName::findOrFail(\$id);
        return view('admin.$plural.edit', compact('item'));
    }

    public function update(Request \$request, \$id) {
        \$validated = \$request->validate([
            $validationStr
        ]);

        // Handle checkboxes
";
    foreach ($e['fields'] as $field => $type) {
        if ($type === 'checkbox') {
            $controllerCode .= "        \$validated['$field'] = \$request->has('$field');\n";
        }
    }

    $controllerCode .= "
        \$item = $modelName::findOrFail(\$id);
        \$item->update(\$validated);
        return redirect('/admin/$plural')->with('success', '{$e['name']} updated successfully.');
    }

    public function destroy(\$id) {
        $modelName::findOrFail(\$id)->delete();
        return redirect('/admin/$plural')->with('success', '{$e['name']} deleted successfully.');
    }
}
";

    file_put_contents(__DIR__ . "/app/Http/Controllers/Admin/$controllerName.php", $controllerCode);

    // 2. Views Directory
    $viewsDir = __DIR__ . "/resources/views/admin/$plural";
    if (!is_dir($viewsDir)) mkdir($viewsDir, 0777, true);

    // 3. Index View
    $tableHeaders = "";
    $tableCells = "";
    $i = 0;
    foreach ($e['fields'] as $field => $type) {
        if ($i++ < 3) {
            $tableHeaders .= "<th class='p-3 text-left'>".ucfirst(str_replace('_', ' ', $field))."</th>\n                ";
            $tableCells .= "<td class='p-3'>{{ \$item->$field }}</td>\n                ";
        }
    }

    $indexCode = "@extends('admin.layout')
@section('content')
<div class='flex justify-between items-center mb-6'>
    <h2 class='text-2xl font-bold'>Manage {$e['name']}s</h2>
    <a href='/admin/$plural/create' class='bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700'>Add New</a>
</div>
<div class='bg-white rounded shadow overflow-hidden'>
    <table class='w-full'>
        <thead class='bg-gray-200'>
            <tr>
                <th class='p-3 text-left'>ID</th>
                $tableHeaders<th class='p-3 text-left'>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach(\$data as \$item)
            <tr class='border-b hover:bg-gray-50'>
                <td class='p-3'>{{ \$item->id }}</td>
                $tableCells<td class='p-3 flex gap-2'>
                    <a href='/admin/$plural/{{ \$item->id }}/edit' class='text-blue-500 hover:underline'>Edit</a>
                    <form action='/admin/$plural/{{ \$item->id }}' method='POST' onsubmit='return confirm(\"Delete this item?\")'>
                        @csrf @method('DELETE')
                        <button type='submit' class='text-red-500 hover:underline'>Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class='mt-4'>{{ \$data->links() }}</div>
@endsection
";
    file_put_contents("$viewsDir/index.blade.php", $indexCode);

    // 4. Create View
    $formFields = "";
    foreach ($e['fields'] as $field => $type) {
        $label = ucfirst(str_replace('_', ' ', $field));
        if ($type === 'textarea') {
            $formFields .= "<div class='mb-4'><label class='block mb-1'>$label</label><textarea name='$field' class='w-full border p-2 rounded'></textarea></div>\n";
        } elseif ($type === 'checkbox') {
            $formFields .= "<div class='mb-4'><label class='flex items-center gap-2'><input type='checkbox' name='$field' value='1'> $label</label></div>\n";
        } else {
            $formFields .= "<div class='mb-4'><label class='block mb-1'>$label</label><input type='$type' name='$field' class='w-full border p-2 rounded'></div>\n";
        }
    }

    $createCode = "@extends('admin.layout')
@section('content')
<h2 class='text-2xl font-bold mb-6'>Add New {$e['name']}</h2>
<form action='/admin/$plural' method='POST' class='bg-white p-6 rounded shadow max-w-2xl'>
    @csrf
    $formFields
    <button type='submit' class='bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700'>Save</button>
    <a href='/admin/$plural' class='ml-4 text-gray-500 hover:underline'>Cancel</a>
</form>
@endsection
";
    file_put_contents("$viewsDir/create.blade.php", $createCode);

    // 5. Edit View
    $editFields = "";
    foreach ($e['fields'] as $field => $type) {
        $label = ucfirst(str_replace('_', ' ', $field));
        if ($type === 'textarea') {
            $editFields .= "<div class='mb-4'><label class='block mb-1'>$label</label><textarea name='$field' class='w-full border p-2 rounded'>{{ \$item->$field }}</textarea></div>\n";
        } elseif ($type === 'checkbox') {
            $editFields .= "<div class='mb-4'><label class='flex items-center gap-2'><input type='checkbox' name='$field' value='1' {{ \$item->$field ? 'checked' : '' }}> $label</label></div>\n";
        } else {
            $editFields .= "<div class='mb-4'><label class='block mb-1'>$label</label><input type='$type' name='$field' value='{{ \$item->$field }}' class='w-full border p-2 rounded'></div>\n";
        }
    }

    $editCode = "@extends('admin.layout')
@section('content')
<h2 class='text-2xl font-bold mb-6'>Edit {$e['name']}</h2>
<form action='/admin/$plural/{{ \$item->id }}' method='POST' class='bg-white p-6 rounded shadow max-w-2xl'>
    @csrf @method('PUT')
    $editFields
    <button type='submit' class='bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700'>Update</button>
    <a href='/admin/$plural' class='ml-4 text-gray-500 hover:underline'>Cancel</a>
</form>
@endsection
";
    file_put_contents("$viewsDir/edit.blade.php", $editCode);
}
echo "Admin CRUD files generated successfully.\n";
