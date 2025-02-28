<?php include "./partials/head.php";
include './helpers.php';
include './api/getPosts.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(!isset($_SESSION['userID'])) {
    $_SESSION['error'] = 'You need to be logged in to post!';
    redirect('/login.php');
}
?>

<body class="bg-OffWhite">
    <?php include "./partials/navbar.php" ?>

    <?php include "./partials/errorBox.php" ?>

    <div id="informationContainer" class="w-full flex justify-center flex-col items-center mt-8">

        <!-- Header -->
        <div class="flex items-center justify-center w-3/4 mx-auto ">
            <hr class="flex-grow border-t border-DarkGrey border-2">
            <span class="px-4 py-1 bg-OffWhite border border-OffWhite rounded-lg text-DarkGrey text-3xl font-bold" id="makePostTitle" aria-live="polite">
                Make a Post
            </span>
            <hr class="flex-grow border-t border-DarkGrey border-2">
        </div> 

        <!-- Form -->
        <div id="formBG" class='w-4/6 h-fit bg-LightGrey rounded-xl shadow-xl pb-4' role="form" aria-labelledby="formTitle">
            <h2 id="formTitle" class="sr-only">Create a new post form</h2>
            <form action="./api/processPost.php" method="POST" aria-describedby="formInstructions">
                <p id="formInstructions" class="sr-only">Fill out the form below to create a new post. Provide a title, content, and category for your post.</p>

                <p class='mt-4 ml-40 text-3xl text-white' for="postTitle">Title:</p>
                <div class='w-full flex items-center justify-center'>
                    <input 
                        required 
                        type='text' 
                        name='title' 
                        id="postTitle"
                        placeholder="Give your post a title..." 
                        class='py-4 px-2 w-5/6 mt-2 rounded-xl shadow-xl'
                        aria-required="true" 
                        aria-describedby="titleDescription"
                    />
                    <span id="titleDescription" class="sr-only">Enter the title of your post.</span>
                </div>

                <p class='mt-4 ml-40 text-3xl text-white' for="postContent">Content:</p>
                <div class='w-full flex items-center justify-center'>
                    <textarea 
                        required 
                        name='content' 
                        id="postContent"
                        placeholder="What would you like to post?" 
                        rows='12' 
                        class='py-4 px-2 w-5/6 mt-2 rounded-xl shadow-xl'
                        aria-required="true"
                        aria-describedby="contentDescription"
                    ></textarea>
                    <span id="contentDescription" class="sr-only">Enter the content for your post.</span>
                </div>

                <p class='mt-4 ml-40 text-3xl text-white' for="postCategory">Category:</p>
                <div class='w-full flex items-center justify-center'>
                    <input 
                        required 
                        type='text' 
                        name='category' 
                        id="postCategory"
                        placeholder="What category is your post?" 
                        class='py-4 px-2 w-5/6 mt-2 rounded-xl shadow-xl'
                        aria-required="true"
                        aria-describedby="categoryDescription"
                    />
                    <span id="categoryDescription" class="sr-only">Specify the category of your post.</span>
                </div>

                <input type='hidden' name='userID' value='<?= $_SESSION['userID']; ?>'/>

                <div class="fixed bottom-20 right-20">
                    <button 
                        type="submit" 
                        class="bg-LightRed text-white px-16 py-8 rounded-lg text-2xl font-semibold shadow-lg hover:bg-DarkGrey"
                        aria-label="Submit your post"
                    >
                        Post ✍️
                    </button>
                </div>
            </form>
        </div>
    
    </div>
</body>
</html>
