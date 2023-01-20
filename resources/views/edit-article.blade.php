<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Modifier votre article
        </h2>
    </x-slot>
    <div class="container mt-5">
        <form action="/edit-article/{{$article->id}}" method="POST">
            @CSRF
            @method('put')
            <div class="mb-3">
                <label class="form-label">Titre de l'article</label>
                <input type="text" class="form-control" aria-describedby="titre" name="title" value="{{$article->title}}">
            </div>
            <div class="mb-3">
                <label for="floatingTextarea">Contenu de votre article</label>
                <textarea class="form-control" rows='20'  name="content">{{$article->content}}</textarea>
            </div>
            <div class="mb-3">
                <label for="floatingTextarea">Catégorie</label>
                <select name="tag">
                    @foreach($tags as $tag)
                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Mettre à jour</button>
        </form>
    </div>
    
</x-app-layout>