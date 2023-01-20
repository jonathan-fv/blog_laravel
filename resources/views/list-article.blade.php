<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Liste des articles publiés
        </h2>
    </x-slot>
    <div class="container mt-5">
        <p>Il y a <span class="">{{ $articles->count() }}</span> article(s)</p>
        <br>
        <table class=table>
            <tr>
                <th>Id</th>
                <th>Titre</th>
                <th>Contenu</th>
                <th>Tags</th>
                <th>Auteur</th>
                <th class="text-center">Actions</th>
            </tr>
            @foreach($articles as $article)
            <tr>
                <td>{{$article->id}}</td>
                <td>{{$article->title}}</td>
                <td>{{$article->content}}</td>
                <td>
                    @foreach($article->tags as $tag)
                        <p>{{ $tag->name }}</p>
                    @endforeach
                </td>
                <td>{{ $article->user->name }}</td>
                <td class="d-flex justify-content-around align-items-center">
                    <a href="{{ route('edit-article', $article->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        <i class="fa-solid fa-pencil"></i>
                    </a>
                    <form action="/show-article/{{$article->id}}" method="POST">
                        @CSRF
                        @method('delete')
                        <button type='submit' class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
    
</x-app-layout>