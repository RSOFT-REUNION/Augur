<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Label;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class LabelController extends Controller
{
    /*
     * Show list label page
     * group = group in the navbar
     * item = item in the navbar
     */
    public function showList()
    {
        $data = [];
        $data['group'] = 'backend';
        $data['item'] = 'label';
        return view('pages.backend.labels.labels-list', $data);
    }

    /*
     * Show add label page
     * group = group in the navbar
     * item = item in the navbar
     */
    public function showAdd()
    {
        $data = [];
        $data['group'] = 'backend';
        $data['item'] = 'label';
        $data['label'] = '';
        return view('pages.backend.labels.labels-add', $data);
    }

    /*
     * Show add label page
     * group = group in the navbar
     * item = item in the navbar
     */
    public function showEdit($id)
    {
        $data = [];
        $data['group'] = 'backend';
        $data['item'] = 'label';
        $data['label'] = Label::where('id', $id)->first();
        $data['label_content'] = Label::where('id', $id)->first()->content;
        return view('pages.backend.labels.labels-add', $data);
    }

    /*
     * Create a label
     * Correct_title = convert title with the good characters
     * Labels cover saved in 'public/images/labels' folder
     */
    public function create(Request $request)
    {
        $correct_title = str_replace(\view()->shared('characters'), \view()->shared('correct_characters'), strtolower($request->title));

        $request->validate([
            'title' => 'required|unique:labels,title',
            'description' => 'required'
        ], [
            'title.required' => "Le nom du label est obligatoire.",
            'title.unique' => "Un label existe déjà avec ce nom.",
            'description.required' => "Le contenu est obligatoire.",
        ]);

        $media = new Media;
        $media->title = str_replace(view()->shared('characters'), view()->shared('correct_characters'), strtolower($request->title)).'.'.$request->cover->extension();
        $media->key = str_replace(view()->shared('characters'), view()->shared('correct_characters'), strtolower($request->title));
        $media->alt = $request->title;
        $media->save();

        $label = new Label;
        $label->title = $request->title;
        $label->slug = $correct_title;
        $label->media_id = $media->id;
        $label->content = $request->description;
        if($label->save()){
            // Optimisation de l'image
            $optimizedImage = Image::make($request->file('cover'))->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->encode();
            Storage::disk('local')->put('public/medias/'.$correct_title. '.' . $request->file('cover')->extension(), $optimizedImage);
            return redirect()->route('bo.labels')->with('success', 'Votre label a bien été créé');
        }
    }

    public function edit(Request $request)
    {
        $label = Label::where('id', $request->label_id)->first();

        $correct_title = str_replace(\view()->shared('characters'), \view()->shared('correct_characters'), strtolower($request->title));

        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ], [
            'title.required' => "Le nom du label est obligatoire.",
            'description.required' => "Le contenu est obligatoire.",
        ]);

        if($request->cover) {
            $media = new Media;
            $media->title = str_replace(view()->shared('characters'), view()->shared('correct_characters'), strtolower($request->title)).'.'.$request->cover->extension();
            $media->key = str_replace(view()->shared('characters'), view()->shared('correct_characters'), strtolower($request->title));
            $media->alt = $request->title;
            $media->save();
        }

        if($request->title != $label->title) {
            $label->title = $request->title;
        }
        $label->content = $request->description;
        if($request->cover) {
            $label->media_id = $media->id;
        }
        if($label->update()){
            if($request->cover) {
                // Optimisation de l'image
                $optimizedImage = Image::make($request->file('cover'))->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->encode();
                Storage::disk('local')->put('public/medias/'.$correct_title. '.' . $request->file('cover')->extension(), $optimizedImage);
            }
            return redirect()->route('bo.labels')->with('success', 'Votre label a bien été modifié.');
        }
    }
}
