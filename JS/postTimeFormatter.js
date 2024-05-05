function formatPostTime(posts) {
    posts.forEach(function(post) {
        var postDate = new Date(post.created_at);
        var currentDate = new Date();
        var timeDifference = currentDate - postDate;
        var timeElapsed;

        var seconds = Math.floor(timeDifference / 1000);
        var minutes = Math.floor(seconds / 60);
        var hours = Math.floor(minutes / 60);
        var days = Math.floor(hours / 24);

        if (days >= 2) {
            timeElapsed = postDate.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });
        } else if (days === 1) {
            timeElapsed = '1 day ago';
        } else if (hours >= 1) {
            timeElapsed = hours + 'h ago';
        } else if (minutes >= 1) {
            timeElapsed = minutes + 'm ago';
        } else {
            timeElapsed = 'Just now';
        }

        post.timeElapsed = timeElapsed; 
    });

    return posts;
}
