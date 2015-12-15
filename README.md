# Lighmblr

## Introduction
This code came from a simple constatation : Browsing a "reaction tumblr" (Like lesjoiesducode.fr ) from a smartphone / 3G is close to impossible because of how heavy theses gifs can be. 

Currently this only support lesjoiesducode.fr as the gifs/title detection has been hardcoded, but I'm planning to change that in the futur. 

## Process
The process is fairly simple : 
- Fetch gifs and title from the tumblr
- If the compressed version of the gif is not available in the cache, it launch a compression
- The output is shown to the user

When you access a page where none of the gifs are cache, it can take up to a minute to load the page, otherwise it's as fast as any other PHP script. 

## Libraries : 

- Simple HTML DOM - http://simplehtmldom.sourceforge.net : For the DOM manipulation to retrieve gifs and title

- Skeleton - http://getskeleton.com/ : A light CSS framework. (To have something \*a bit\* responsive)

- Gifsicle/Giflossy - https://github.com/pornel/giflossy : The actual gif compressor, called from a shell_exec. (Not exactly idea, I know, but PHP GD was miles away from the result of gifsicle.)
