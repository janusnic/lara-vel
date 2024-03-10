# Models



Якщо потрібно оновити існуючу модель або створити нову модель, коли відповідної моделі не існує, застосовують метод updateOrCreate.
   App\Models\Category::updateOrCreate(['name'=>'cats'], ['status'=>1]);
= App\Models\Category {#6421
   id: 42,
   created_at: "2024-02-22 09:23:21",
   updated_at: "2024-02-22 09:25:23",
   deleted_at: null,
   name: "cats",
   slug: "cats",
   status: 1,
   cover: null,
 }

Якщо потрібно виконати кілька оновлень в одному запиті, тоді слід використовувати замість updateOrCreate метод upsert. Перший аргумент методу складається зі значень, які потрібно вставити або оновити,  другий аргумент містить список стовпців, які однозначно ідентифікують записи в таблиці. Третій і останній аргумент методу - це масив стовпців, які слід оновити, якщо відповідний запис уже існує в базі даних.

App\Models\Category::upsert([['name'=>'cats', 'slug'=>'cats', 'status'=>2], ['name'=>'dolorem', 'slug'=>'dolorem', 'status'=>1]],['name', 'slug'], ['status']);


Eloquent надає методи isDirty, isClean і wasChanged для перевірки внутрішнього стану моделі та визначення того, як змінилися її атрибути з моменту початкового отримання моделі.
Метод isDirty визначає, чи були змінені будь-які атрибути моделі після отримання моделі. Ви можете передати конкретне ім’я атрибута або масив атрибутів у метод isDirty, щоб визначити, чи є якийсь із атрибутів брудним. Метод isClean визначить, чи залишився атрибут незмінним після отримання моделі. Цей метод також приймає необов’язковий аргумент атрибута:


$category = App\Models\Category::create(['name'=>'dogs']);
= App\Models\Category {#6410
    name: "dogs",
    slug: "dogs",
    updated_at: "2024-02-22 10:07:18",
    created_at: "2024-02-22 10:07:18",
    id: 45,
  }

$category->isClean('name'); // true
$category->isDirty('name'); // false
$category->name="Engry dog"; // "Engry dog"
$category->isDirty('name'); // true
$category->isClean('name'); // false
$category->save(); // true
$category->isDirty('name'); // false

Метод wasChanged визначає, чи були змінені якісь атрибути під час останнього збереження моделі в поточному циклі запиту. За потреби ви можете передати назву атрибута, щоб побачити, чи був змінений певний атрибут:

$category->wasChanged('name'); // true
$category->wasChanged(['name', 'slug']); // true
$category->wasChanged(['name', 'updated_at']); // true


Метод getOriginal повертає масив, що містить оригінальні атрибути моделі незалежно від будь-яких змін у моделі з моменту її отримання. Якщо необхідно, ви можете передати конкретне ім’я атрибута, щоб отримати вихідне значення певного атрибута:

$category->getOriginal();
= [
    "name" => "Engry dog",
    "slug" => "dogs",
    "updated_at" => Illuminate\Support\Carbon @1708596613 {#6445
      date: 2024-02-22 10:10:13.0 UTC (+00:00),
    },
    "created_at" => Illuminate\Support\Carbon @1708596438 {#6562
      date: 2024-02-22 10:07:18.0 UTC (+00:00),
    },
    "id" => 45,
  ]


$category->slug = "engry-dog"; // "engry-dog"
$category->getOriginal(); // Array of original attributes...
= [
    "name" => "Engry dog",
    "slug" => "dogs",
    "updated_at" => Illuminate\Support\Carbon @1708596613 {#6565
      date: 2024-02-22 10:10:13.0 UTC (+00:00),
    },
    "created_at" => Illuminate\Support\Carbon @1708596438 {#6425
      date: 2024-02-22 10:07:18.0 UTC (+00:00),
    },
    "id" => 45,
  ]

$category->save();// true
$category->wasChanged();// true

$category->getOriginal(); // Array of original attributes...
= [
    "name" => "Engry dog",
    "slug" => "engry-dog",
    "updated_at" => Illuminate\Support\Carbon @1708597398 {#6375
      date: 2024-02-22 10:23:18.0 UTC (+00:00),
    },
    "created_at" => Illuminate\Support\Carbon @1708596438 {#6399
      date: 2024-02-22 10:07:18.0 UTC (+00:00),
    },
    "id" => 45,
  ]

Щоб видалити запис, можна викликати метод delete екземпляру моделі:
$brand = Brand::find(1);
$brand->delete();
Видалення існуючої моделі за її первинним ключем:
якщо ви знаєте первинний ключ моделі, ви можете видалити модель без її явного отримання. 
Brand::destroy(1);
метод delete прийматиме кілька первинних ключів, масив первинних ключів або колекцію первинних ключів:
Brand::destroy(1, 2, 3);
Brand::destroy([1, 2, 3]);
Brand::destroy(collect([1, 2, 3]));

Метод delete завантажує кожну модель окремо та викликає метод delete для кожної моделі. Можна створити запит Eloquent, щоб видалити всі моделі, які відповідають критеріям запиту:

$deleted = Category::where('status', 0)->delete();

Під час виконання оператора масового видалення через Eloquent події видалення моделі не надсилатимуться для видалених моделей. Це пояснюється тим, що моделі ніколи фактично не витягуються під час виконання оператора delete.

Ви можете викликати метод truncate, щоб видалити всі пов’язані з моделлю записи бази даних. Операція truncate також скине всі ідентифікатори, що автоматично збільшуються, у пов’язаній з моделлю таблиці:
Brand::truncate();

Окрім фактичного видалення записів з бази даних, Eloquent може м’яко видаляти записи. Коли запис м’яко видаляються, він фактично не видаляються з бази даних. Замість цього для нього встановлюється атрибут deleted_at, який вказує дату й час, коли запис було видалено. Щоб увімкнути м’яке видалення, додайте до моделі трейт Illuminate\Database\Eloquent\SoftDeletes:
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
 
class Brand extends Model {
    use SoftDeletes;
}
Функція SoftDeletes автоматично конвертує атрибут deleted_at до екземпляра DateTime / Carbon.

Ви також повинні додати стовпець deleted_at до таблиці бази даних. Конструктор схем Laravel містить допоміжний метод для створення цього стовпця:
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
 
Schema::table('brands', function (Blueprint $table) {
    $table->softDeletes();
});
 
Schema::table('brands', function (Blueprint $table) {
    $table->dropSoftDeletes();
});

Щоб визначити, чи був даний екземпляр моделі м’яко видалений, ви можете використати метод trashed:

if ($category->trashed()) {
    echo "This trasged";
}

$category->delete(); // true

if ($category->trashed()) {
    echo "This trasged";
} //This trasged

Щоб скасувати видалення запису, ви можете викликати метод restore в екземплярі моделі. Метод restore встановить стовпець deleted_at моделі на нуль:

$category->restore();

Ви також можете використовувати метод restore в запиті для відновлення кількох моделей. 

Category::withTrashed()
   	->restore();

М’яко видалені моделі будуть автоматично виключені з результатів запиту. Однак ви можете змусити м’яко видалені моделі включити в результати запиту, викликавши метод withTrashed у запиті: $brand = Brand::withTrashed()->get();
public function trashed(){
   $brands = Brand::onlyTrashed()->paginate();
   return view('admin.brands.trashed', compact('brands'));
}
Ви також можете використовувати метод відновлення в запиті для відновлення кількох моделей: Brand::withTrashed()->restore();
public function restore(){
   Brand::withTrashed()->restore();
   return redirect(route('brands.trashed'));
}



