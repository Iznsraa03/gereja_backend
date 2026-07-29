<?php

$dir = __DIR__ . '/app/Models';
$models = scandir($dir);

$softDeletes = [
    'ChurchCategory.php', 'Church.php', 'WorshipSchedule.php',
    'Facility.php', 'Activity.php', 'Announcement.php', 'Article.php'
];

foreach ($models as $file) {
    if (in_array($file, ['.', '..', 'User.php'])) continue;

    $path = $dir . '/' . $file;
    $content = file_get_contents($path);

    $uses = "";
    if (in_array($file, $softDeletes)) {
        $content = str_replace('use Illuminate\Database\Eloquent\Model;', "use Illuminate\Database\Eloquent\Model;\nuse Illuminate\Database\Eloquent\SoftDeletes;", $content);
        $uses = "    use SoftDeletes;\n";
    }

    $content = preg_replace('/class (\w+) extends Model\n\{/', "class $1 extends Model\n{\n$uses    protected \$guarded = [];\n", $content);

    // Relations
    if ($file === 'Church.php') {
        $content = preg_replace('/\}$/', "
    public function category() { return \$this->belongsTo(ChurchCategory::class); }
    public function schedules() { return \$this->hasMany(WorshipSchedule::class); }
    public function facilities() { return \$this->belongsToMany(Facility::class); }
    public function images() { return \$this->hasMany(ChurchImage::class); }
    public function scopeCloseTo(\$query, \$lat, \$lng) {
        \$haversine = \"(6371 * acos(cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) + sin(radians(?)) * sin(radians(latitude))))\";
        return \$query->selectRaw(\"*, {\$haversine} AS distance\", [\$lat, \$lng, \$lat])->orderBy('distance');
    }
}
", $content);
    }
    
    file_put_contents($path, $content);
}
echo "Models updated.\n";
