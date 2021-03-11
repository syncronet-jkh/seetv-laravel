<?php

namespace App\Http\Controllers;

use App\Models\Term;
use Illuminate\Http\Request;
use Inertia\Inertia;
use function __;
use function back;
use function redirect;
use function response;
use function session;

class TermController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Term::class);

        return Inertia::render('Terms/Index', [
            'terms' => Term::query()->paginate(),
            'title' => __('Terms & Conditions'),
            'headers' => [
                [
                    'text' => __('Section'),
                    'value' => 'section',
                    'align' => 'start'
                ],
                [
                    'text' => __('Paragraph'),
                    'value' => 'paragraph',
                ],
                [
                    'text' => __('Content'),
                    'value' => 'content'
                ],
                [
                    'text' => __('Actions'),
                    'value' => 'actions',
                    'sortable' => false
                ]
            ],
        ]);
    }

    public function create()
    {
        $this->authorize('create', Term::class);

        return Inertia::render('Terms/Create', [
            'title' => __('Create terms'),
        ]);
    }

    public function store(Request $request)
    {
        $this->authorize('create', Term::class);

        $term = Term::create(
            $request->validate([
                'section' => ['required', 'string', 'max:255'],
                'paragraph' => ['required', 'string', 'max:255'],
                'content' => ['required', 'string']
            ])
        );

        $request->session()->flash('flashMessage', __('Term created.'));

        return back();
    }

    public function show(Term $term)
    {
        $this->authorize('view', $term);

        return Inertia::render('Terms/Show', ['term' => $term]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Term $term
     * @return \Illuminate\Http\Response
     */
    public function edit(Term $term)
    {
        //
    }

    public function update(Request $request, Term $term)
    {
        $this->authorize('update', $term);

        $term->update(
            $request->validate([
                'section' => 'string|max:255',
                'paragraph' => 'string|max:255',
                'content' => 'string'
            ])
        );

        $request->session()->flash('flashMessage', __('Term updated.'));

        return back();
    }

    public function destroy(Term $term)
    {
        $this->authorize('delete', $term);

        $term->delete();

        session()->flash('flashMessage', __('Term deleted.'));

        return back();
    }
}
