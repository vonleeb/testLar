<?php

namespace App\Http\Controllers;

use App\Feedback;
use App\Http\Helpers\SortHelper;
use App\Http\Requests\FeedbackRequest;

class FeedbackController extends Controller
{
    public function store(FeedbackRequest $request)
    {
        $path = $request->file('photo')->store('public');
        $validated = $request->validated();
        $validated['photo_name'] = str_replace('public/', '' , $path);
        Feedback::create($validated);

        return redirect('/')->with('status', 'Feedback successfully added');
    }

    public function delete($id)
    {
        Feedback::destroy($id);

        return redirect('/')->with('status', 'Feedback successfully removed');
    }

    public function main()
    {
        $sorting = SortHelper::getSortAndOrder(Feedback::ALLOWED_SORT, Feedback::DEFAULT_SORT);

        return view('main', ['feedbacks' => Feedback::orderBy($sorting['sort'], $sorting['order'])->get(),
                                   'sorting' => Feedback::ALLOWED_SORT,
        ]);
    }
}
