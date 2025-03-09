<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class AdminFaqController extends Controller
{
    public function index() {
      $faqs = Faq::all();

      return view('admin.user.faqs.index', compact('faqs'));
    }

    public function create() {
      return view('admin.user.faqs.create');
    }

    public function store(Request $request) {
      $request->validate([
        'question' => 'required',
        'answer' => 'required',
      ]);

      $faq = new Faq();

      $faq->question = $request->question;
      $faq->answer = $request->answer;
      $faq->save();

      return redirect()->route('admin_faqs_index')->with('success', 'FAQ Created Successfully');
    }

    public function edit(Faq $faq) {
      return view('admin.user.faqs.edit', compact('faq'));
    }

    public function update(Request $request, Faq $faq) {
      $request->validate([
        'question' => 'required',
        'answer' => 'required',
      ]);

      $faq->question = $request->question;
      $faq->answer = $request->answer;
      $faq->update();

      return redirect()->route('admin_faqs_index')->with('success', 'FAQ Updated Successfully');
    }

    public function delete(Faq $faq) {
      $faq->delete();
      
      return redirect()->route('admin_faqs_index')->with('success', 'FAQ Deleted Successfully');
    }
}
