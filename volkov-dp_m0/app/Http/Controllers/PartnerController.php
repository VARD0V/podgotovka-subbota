<?php
namespace App\Http\Controllers;
use App\Http\Requests\PartnerRequest;
use App\Models\MaterialType;
use App\Models\Partner;
use App\Models\PartnerProduct;
use App\Models\PartnerType;
use App\Models\ProductType;

class PartnerController extends Controller
{
    public function index()
    {
        $partners = Partner::with(['partnerProducts.product'])->get();

        $partners->each(function ($partner) {
            $partner->total_cost = $partner->partnerProducts->sum(function ($partnerProduct) {
                return $partnerProduct->product->minimal_cost * $partnerProduct->amount;
            });
        });

        // Возвращаем представление с данными партнеров
        return view('partners.index', compact('partners'));
    }
    public function create()
    {
        // Получаем все типы партнеров для выпадающего списка
        $types = PartnerType::all();
        return view('partners.create', compact('types'));
    }
    public function store(PartnerRequest $request)
    {
        // Создаем партнера с валидированными данными
        $partner = Partner::create($request->validated());

        // Перенаправляем на страницу списка партнеров
        return redirect()->route('partners.index');
    }
    public function edit(Partner $partner)
    {
        // Получаем все типы партнеров и товары этого партнера
        $types = PartnerType::all();
        $partner_products = PartnerProduct::where('id_partner', $partner->id)->get();

        // Возвращаем форму редактирования с данными
        return view('partners.edit', compact('partner', 'types', 'partner_products'));
    }
    public function update(PartnerRequest $request, Partner $partner)
    {
        // Обновляем данные партнера
        $partner->update($request->validated());

        // Перенаправляем на страницу списка партнеров
        return redirect()->route('partners.index');
    }
    public function products(Partner $partner)
    {
        // Получаем все товары партнера
        $partner_products = PartnerProduct::where('id_partner', $partner->id)->get();

        // Возвращаем представление истории с данными
        return view('partners.products', compact('partner', 'partner_products'));
    }
    //Method
    public function method_4m(ProductType $product_type, MaterialType $material_type, int $quantity, float $p1, float $p2, int $in_stock) {
        try {
            // Проверка корректности входных параметров
            if ($quantity <= 0 || $in_stock < 0 || $p1 <= 0 || $p2 <= 0) {
                return -1;
            }
            // Рассчитываем сколько нужно произвести (учитывая наличие на складе)
            $to_produce = max(0, $quantity - $in_stock);
            if ($to_produce <= 0) {
                return 0;
            }
            // Расчет материала с учетом брака
            $material_per_unit = $p1 * $p2 * $product_type->coefficient;
            $total_material = $material_per_unit * $to_produce * (1 + $material_type->defective_percent / 100);
            // Возвращаем округленное значение
            return (int) ceil($total_material);
        } catch (\Exception $exception) {
            return -1;
        }
    }
}
