$(document).ready(function() {
  var portfolioSlide = $('#portfolio-slide');
  var portfolioContent = $(portfolioSlide).children();
  var stack = new Array();
  var numElems = 0;

  for (var elem in data) {
    var elemHTML = '';

    if (data[elem].type == 'invisible') {
      elemHTML += '<div class="portfolio-block-invisible"></div>';
    } else {
      elemHTML += '<div class="portfolio-block bg-' + data[elem].bg.color + '"';
      elemHTML += 'style="background-image: url(\'img/' + data[elem].bg.image + '\');';
      if (data[elem].bg.backgroundSize) elemHTML += 'background-size:' + data[elem].bg.backgroundSize;
      elemHTML += '"><div class="portfolio-text"><h4>' + data[elem].title +'</h4>';
      elemHTML += '<h5><small>' + data[elem].date + '</small></h5>';
      elemHTML += '<p>' + data[elem].description +'</p>';
      if (data[elem].href) elemHTML += '<a href="' + data[elem].href + '"><button>Visit</button></a>';
      if (data[elem].code) elemHTML += '<a href="' + data[elem].code + '"><button>Code</button></a>';
      if (data[elem].gallery) elemHTML += '<button class="gallery-button" data-target="#' + elem + '">Gallery</button>';
      elemHTML += '</div>';


      elemHTML += '<ul class="tags">';
      for (var tag in data[elem].tags) {
        elemHTML += '<li class="' + tagColors[data[elem].tags[tag]] + '">' + data[elem].tags[tag] + '</li>';
      }
      elemHTML += '</ul></div>';
    }

    var $elem = $(elemHTML);
    $(portfolioContent).append($elem);
    numElems++;


    if (data[elem].gallery) {
      var galleryHTML = '<div class="gallery ' + data[elem].galleryClasses + '" id="' + elem + '">';
      for (var img in data[elem].gallery) {
        galleryHTML += '<a target="_blank" href="img/fullsize/' + data[elem].gallery[img] + '">';
        galleryHTML += '<img src="img/' + data[elem].gallery[img] + '"></a>';
      }
      galleryHTML += '</div>';
      stack.push(galleryHTML)
    }

    if (numElems % 3 == 0) {
      var stackedGallery = stack.pop();
      while (stackedGallery) {
        $(portfolioContent).append($(stackedGallery));
        stackedGallery = stack.pop();
      }
    }
  }


  $('.gallery-button').each(function(key, value) {
    $(value).on('click', function(e) {
      var target = $(this).data('target');
      if ($(target).hasClass('expand')) {
        $('.gallery-button').trigger('collapse');
      } else {
        $('.gallery-button').trigger('collapse');
        $(target).addClass('expand');
      }
    });

    $(value).on('collapse', function(e) {
      var target = $(this).data('target');
      $(target).removeClass('expand');
    });
  });
});

tagColors = {
  Team: 'bg-orange',
  Frontend: 'bg-blue',
  Design: 'bg-green',
  Backend: 'bg-red',
  Website: 'bg-purple',
  Logo: 'bg-yellow',
  Mockup: 'bg-bluegrey'
}

data = {
  bpWebsite: {
    type: 'link',
    title: 'Blueprint Website',
    date: 'Dec 2014 - Present',
    description: 'In Progress',
    href: null,
    code: 'https://github.com/calblueprint/calblueprint.org',
    tags: {
      tag1: 'Team',
      tag2: 'Frontend',
      tag3: 'Design',
      tag4: 'Website'
    },
    bg: {
      color: 'blue',
      image: 'bp.png'
    }
  },
  revolv: {
    type: 'link',
    title: 'RE-volv Crowdfunding Site',
    date: 'Aug 2014 - Present',
    description: 'In Progress. Led a team to develop a crowdfunding site for RE-volv.',
    href: null,
    code: 'https://github.com/calblueprint/revolv',
    tags: {
      tag1: 'Team',
      tag2: 'Backend',
      tag3: 'Website'
    },
    bg: {
      color: 'blue',
      image: 'revolv.jpg'
    }
  },
  odalc: {
    type: 'link',
    title: 'ODALC Bridge',
    date: 'Feb - May 2014',
    description: 'Helped develop a course manageent website for ODALC.',
    href: "http://bridge.odalc.org",
    code: 'https://github.com/calblueprint/odalc',
    tags: {
      tag1: 'Team',
      tag2: 'Backend',
      tag3: 'Website'
    },
    bg: {
      color: 'purple',
      image: 'odalc.jpg'
    }
  },
  bpsf: {
    type: 'link',
    title: 'Friends and Family Grants',
    date: 'Sep 2013 - Sep 2014',
    description: 'Helped develop a crowdfunding website for the Berkeley Public Schools Fund',
    href: "https://schoolsfund-friendsandfamily.herokuapp.com",
    code: 'https://github.com/calblueprint/bpsf',
    tags: {
      tag1: 'Team',
      tag2: 'Frontend',
      tag3: 'Design',
      tag4: 'Website'
    },
    bg: {
      color: 'orange',
      image: 'bpsf.png'
    }
  },
  greenGalaxy: {
    type: 'link',
    title: 'Green Galaxy',
    date: 'Aug 2013',
    description: 'Website for a friend doing environmental work in the community.',
    href: "http://ourgreengalaxy.org",
    code: 'https://github.com/vivekraghuram/ourgreengalaxy',
    tags: {
      tag1: 'Frontend',
      tag2: 'Design',
      tag3: 'Website'
    },
    bg: {
      color: 'green',
      image: 'greengalaxy.png'
    }
  },
  ppts: {
    type: 'link',
    title: 'Mock Business Plan Powerpoints',
    date: 'Sep 2011 - Dec 2012',
    description: 'Mock business plan powerpoints made for Cubed and TeenGurus',
    href: "https://www.dropbox.com/sh/0wplt2j39sxwfmt/AAAwP_IpAVTfNIEcnS3T_3wQa?dl=0",
    tags: {
      tag2: 'Design'
    },
    bg: {
      color: 'offwhite',
      image: 'ppts.png',
      backgroundSize: 'cover'
    }
  },
  greenGalaxylogos: {
    type: 'gallery',
    title: 'Green Galaxy Logos',
    date: 'Aug 2013',
    description: 'Logos for a website for a friend doing environmental work in the community.',
    gallery: {
      img1: 'greengalaxy/1.png',
      img2: 'greengalaxy/2.png',
      img3: 'greengalaxy/3.png',
      img4: 'greengalaxy/4.png',
      img5: 'greengalaxy/5.png',
      img6: 'greengalaxy/6.png'
    },
    galleryClasses: '',
    tags: {
      tag1: 'Design',
      tag2: 'Logo'
    },
    bg: {
      color: 'bluegrey',
      image: 'greengalaxy/1.png',
      backgroundSize: 'contain'
    }
  },
  mvdeca: {
    type: 'gallery',
    title: 'MVDECA Assorted',
    date: 'May 2011 - May 2013',
    description: 'Logos, mockups and business cards made for Monta Vista DECA.',
    gallery: {
      img1: 'mvdeca/1.png',
      img2: 'mvdeca/2.png',
      img3: 'mvdeca/3.png',
      img4: 'mvdeca/4.png',
      img5: 'mvdeca/5.png',
      img6: 'mvdeca/6.png',
      img7: 'mvdeca/7.png',
      img8: 'mvdeca/8.png',
      img9: 'mvdeca/9.png',
      img10: 'mvdeca/10.png',
      img11: 'mvdeca/11.png',
      img12: 'mvdeca/12.png',
      img13: 'mvdeca/13.png',
    },
    galleryClasses: '',
    tags: {
      tag1: 'Design',
      tag2: 'Logo',
      tag3: 'Mockup'
    },
    bg: {
      color: 'offwhitelight',
      image: 'mvdeca/10.png',
      backgroundSize: 'contain'
    }
  },
  econ: {
    type: 'gallery',
    title: 'Economics Comic',
    date: 'April 2013',
    description: 'A comic made for economics detailing the Epic Economic Adventures of Kim Jong Un.',
    gallery: {
      img1: 'econ/1.png',
      img2: 'econ/2.png',
      img3: 'econ/3.png',
      img4: 'econ/4.png',
      img5: 'econ/5.png',
      img6: 'econ/6.png',
      img7: 'econ/7.png',
      img8: 'econ/8.png',
      img9: 'econ/9.png',
      img10: 'econ/10.png',
    },
    galleryClasses: 'white-images',
    tags: {
      tag1: 'Design'
    },
    bg: {
      color: 'offwhitelight',
      image: 'econ/1.png',
      backgroundSize: 'cover'
    }
  },
  teengurus: {
    type: 'gallery',
    title: 'TeenGurus',
    date: 'Sep - Dec 2012',
    description: 'Logos and mockups for a mock business plan competition.',
    gallery: {
      img1: 'teengurus/1.png',
      img2: 'teengurus/2.png',
      img3: 'teengurus/3.png',
      img4: 'teengurus/4.png',
    },
    galleryClasses: 'white-images',
    tags: {
      tag1: 'Design',
      tag2: 'Logo',
      tag2: 'Mockup'
    },
    bg: {
      color: 'bluegreylight',
      image: 'teengurus/1.png',
      backgroundSize: 'contain'
    }
  },
  atcupertino: {
    type: 'gallery',
    title: '@Cupertino',
    date: 'Jan 2012',
    description: 'Logos made for a city event to promote local business.',
    gallery: {
      img1: '@cupertino/1.png',
      img2: '@cupertino/2.png',
      img3: '@cupertino/3.png',
      img4: '@cupertino/4.png'
    },
    galleryClasses: '',
    tags: {
      tag1: 'Design',
      tag2: 'Logo',
    },
    bg: {
      color: 'offwhitelight',
      image: '@cupertino/2.png',
      backgroundSize: 'contain'
    }
  },
  cubed: {
    type: 'gallery',
    title: 'Cubed',
    date: 'Sep - Dec 2011',
    description: 'Logos and mockups for a mock business plan competition.',
    gallery: {
      img1: 'cubed/1.png',
      img2: 'cubed/2.png',
      img3: 'cubed/3.png',
      img4: 'cubed/4.png',
      img5: 'cubed/5.png',
      img6: 'cubed/6.png'
    },
    galleryClasses: '',
    tags: {
      tag1: 'Design',
      tag2: 'Logo',
      tag2: 'Mockup'
    },
    bg: {
      color: 'offwhite',
      image: 'cubed/2.png',
      backgroundSize: 'contain'
    }
  },
  invisible1: {
    type: 'invisible'
  },
  invisible2: {
    type: 'invisible'
  }
}
