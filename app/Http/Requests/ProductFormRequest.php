<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Allow all authenticated users
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'stock_quantity' => 'required|integer|min:0',
            'image_url' => 'nullable|url',
            'spec_key' => 'nullable|array',
            'spec_value' => 'nullable|array',
            'is_active' => 'boolean'
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Product name is required.',
            'name.max' => 'Product name must not exceed 255 characters.',
            'description.required' => 'Product description is required.',
            'price.required' => 'Product price is required.',
            'price.numeric' => 'Product price must be a valid number.',
            'price.min' => 'Product price must be at least 0.',
            'category.required' => 'Product category is required.',
            'brand.required' => 'Product brand is required.',
            'stock_quantity.required' => 'Stock quantity is required.',
            'stock_quantity.integer' => 'Stock quantity must be a whole number.',
            'stock_quantity.min' => 'Stock quantity must be at least 0.',
            'image_url.url' => 'Image URL must be a valid URL.',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        // Process specifications into a proper array
        if ($this->has('spec_key') && $this->has('spec_value')) {
            $specs = array_combine($this->spec_key ?? [], $this->spec_value ?? []);
            $specifications = array_filter($specs, function($key, $value) {
                return !empty($key) && !empty($value);
            }, ARRAY_FILTER_USE_BOTH);
            
            $this->merge([
                'specifications' => $specifications
            ]);
        }
    }

    /**
     * Get the validated data with processed specifications.
     */
    public function validated($key = null, $default = null)
    {
        $validated = parent::validated($key, $default);
        
        // Ensure specifications is included
        if (!isset($validated['specifications'])) {
            $validated['specifications'] = [];
        }
        
        // Ensure is_active is boolean
        $validated['is_active'] = $this->has('is_active');
        
        return $validated;
    }
}
