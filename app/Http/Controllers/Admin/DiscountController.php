<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Discount;

class DiscountController extends Controller
{
    public function index()
    {
        $discounts = Discount::all();
        return view('admin.discounts.index', compact('discounts'));
    }

    public function create()
    {
        return view('admin.discounts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:discounts',
            'percentage' => 'required|numeric|min:0|max:100',
        ]);

        Discount::create($request->all());

        return redirect()->route('discounts.index')->with('success', 'Discount created successfully.');
    }

    public function edit(Discount $discount)
    {
        return view('discounts.edit', compact('discount'));
    }

    public function update(Request $request, Discount $discount)
    {
        $request->validate([
            'code' => 'required|unique:discounts,code,' . $discount->id,
            'percentage' => 'required|numeric|min:0|max:100',
        ]);

        $discount->update($request->all());

        return redirect()->route('discounts.index')->with('success', 'Discount updated successfully.');
    }

    public function destroy(Discount $discount)
    {
        $discount->delete();

        return redirect()->route('discounts.index')->with('success', 'Discount deleted successfully.');
    }
}
