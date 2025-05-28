<div class="w-full border border-[#999] rounded-md overflow-hidden">
    <img class="w-full h-auto" src="https://placehold.co/600x300" alt="blog image">
    <div class="p-4">
        <h3 class="font-semibold">
            <a href="<?php the_permalink(); ?>">
                <?php the_title() ?>
            </a>
        </h3>
        <div class="my-4">
            <?php the_excerpt(); ?>
        </div>
        <a class="text-sm" href="<?php the_permalink() ?>">Read More...</a>
    </div>
</div>