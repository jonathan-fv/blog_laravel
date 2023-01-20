<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Editer votre article
        </h2>
    </x-slot>
    <div class="container mt-5">
        <form action="/create-article" method="POST">
            @CSRF
            @method('post')
            <div class="mb-3">
                <label class="form-label">Titre de l'article</label>
                <input type="text" class="form-control" aria-describedby="titre" name="title">
                <input type="hidden" class="form-control" aria-describedby="titre" name="user_id" value="{{ auth()->user()->id }}">
            </div>
            <div class="mb-3">
                <label for="floatingTextarea">Contenu de votre article</label>
                <textarea class="form-control" rows='20'  name="content"></textarea>
            </div>
            <div class="mb-3">
                <label for="floatingTextarea">Catégorie</label>
                <select name="tag[]" multiple>
                    @foreach($tags as $tag)
                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Publier</button>
        </form>
    </div>
    
</x-app-layout>