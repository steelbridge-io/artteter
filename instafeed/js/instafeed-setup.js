// instafeed setup - artteter.com
    
    var userFeed = new Instafeed({
    get: 'user',
    userId: '1108209861',
    accessToken: '1108209861.1e20c91.78ad9cd90834461a999288e839a00272',
    resolution: 'standard_resolution',
    template: '<li><a href="{{link}}" target="_blank" id="{{id}}"><img src="{{image}}" /><ul class="insta-info"><li class="likes">{{likes}}</li><li class="comments">{{comments}}</li></ul></a></li>',
    sortBy: 'most-recent',
    limit: 9,
    links: true
   
  });
  userFeed.run();  