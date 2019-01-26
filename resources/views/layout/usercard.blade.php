<div class="w-full lg:flex mb-2">
 	<div class="w-full border-l border-b border-r border-grey-light lg:border-r-0 lg:border-t lg:border-grey-light bg-white rounded-b lg:rounded-b-none lg:rounded-l p-4 flex flex-col justify-between leading-normal">
 		<div class="flex items-center content-center">
	    	<div class="mb-8 w-full">
	      		<p class="text-sm text-grey-dark flex items-center">
	      			@if($league->owner($user))
		        		<svg class="fill-current text-grey w-3 h-3 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
		          			<path d="M4 8V6a6 6 0 1 1 12 0v2h1a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-8c0-1.1.9-2 2-2h1zm5 6.73V17h2v-2.27a2 2 0 1 0-2 0zM7 6v2h6V6a3 3 0 0 0-6 0z" />
		        		</svg>
		        		Owner
	        		@elseif($user->admin($league))
		        		<svg class="fill-current text-grey w-3 h-3 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
		          			<path d="M4 8V6a6 6 0 1 1 12 0v2h1a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-8c0-1.1.9-2 2-2h1zm5 6.73V17h2v-2.27a2 2 0 1 0-2 0zM7 6v2h6V6a3 3 0 0 0-6 0z" />
		        		</svg>
		        		Admin
	        		@endif
	      		</p>
	      		<p class="text-grey-darker text-base">{{ $user->name }}</p>
	    	</div>
	    	@if(!$league->owner($user))
	    	<div>
	    		<a class="bg-white hover:bg-red text-red-dark font-semibold hover:text-white py-2 px-4 border border-red hover:border-transparent rounded cursor-pointer no-underline" href="">Remove</a>
	    	</div>
	    	@endif
	    </div>
  	</div>
  	<div class="h-48 lg:h-auto lg:w-48 flex-none bg-cover rounded-t lg:rounded-t-none lg:rounded-r text-center overflow-hidden" style="background-image: url('https://pbs.twimg.com/profile_images/885868801232961537/b1F6H4KC_400x400.jpg')" title="{{ $user->name }}">
    	<div class="text-sm"></div>
	</div>
</div>