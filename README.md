# Lighmblr

## Introduction
This code came from a simple constatation : Browsing a "reaction tumblr" (Like lesjoiesducode.fr ) from a smartphone / 3G is close to impossible because of how heavy theses gifs can be. 

This should support all the tumblrs with gifs in post (as it's now  using the Tumblr API)

## Process
The process is fairly simple : 
- Fetch gifs and title from the tumblr
- If the compressed version of the gif is not available in the cache, it launch a compression
- The output is shown to the user

When you access a page where none of the gifs are cache, it can take up to a minute to load the page, otherwise it's as fast as any other PHP script. 

## Libraries : 

- Tumbler API - https://www.tumblr.com/docs/en/api/v2 

- MaterializeCss - http://materializecss.com/ : A CSS Framework following the Material Design guidelines. (To have something \*a bit\* responsive and not too ugly.)

- Gifsicle/Giflossy - https://github.com/pornel/giflossy : The actual gif compressor, called from a shell_exec. (Not exactly idea, I know, but PHP GD was miles away from the result of gifsicle.)
