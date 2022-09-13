/* globals Chart:false, feather:false */

(() => {
  'use strict'
  
  feather.replace({ 'aria-hidden': 'true' })
  var editor = new FroalaEditor('#example');

  
  // import('@editorjs/editorjs');
  // const EditorJS = require('@editorjs/editorjs')

  // var editor = new EditorJS({
  //   holder : 'editorjs',
  //   tools: {
  //     header: {
  //       class: Header,
  //       inlineToolbar: ['marker', 'link'],
  //       config: {
  //         placeholder: 'Header'
  //       },
  //       shortcut: 'CMD+SHIFT+H'
  //     },
  //     image: SimpleImage,

  //     list: {
  //       class: List,
  //       inlineToolbar: true,
  //       shortcut: 'CMD+SHIFT+L'
  //     },

  //     checklist: {
  //       class: Checklist,
  //       inlineToolbar: true,
  //     },

  //     quote: {
  //       class: Quote,
  //       inlineToolbar: true,
  //       config: {
  //         quotePlaceholder: 'Enter a quote',
  //         captionPlaceholder: 'Quote\'s author',
  //       },
  //       shortcut: 'CMD+SHIFT+O'
  //     },

  //     warning: Warning,

  //     marker: {
  //       class:  Marker,
  //       shortcut: 'CMD+SHIFT+M'
  //     },

  //     code: {
  //       class:  CodeTool,
  //       shortcut: 'CMD+SHIFT+C'
  //     },

  //     delimiter: Delimiter,

  //     inlineCode: {
  //       class: InlineCode,
  //       shortcut: 'CMD+SHIFT+C'
  //     },

  //     linkTool: LinkTool,

  //     embed: Embed,

  //     table: {
  //       class: Table,
  //       inlineToolbar: true,
  //       shortcut: 'CMD+ALT+T'
  //     },

  //   },
  //   data: {
  //   },
  //   onReady: function(){
  //     console.log('Editor.js is ready to work!')
  //   },
  //   onChange: function(api, event) {
  //     console.log('something changed', event);
  //   }

  // });
  
  // function customParser(block){
  //   if(block.type === 'linkTool'){
  //     return `<a href="${block.data.link}"> ${block.data.link} </a>`;
  //   }
  //   return;
  // }

  // // const edjsParser =  edjsHTML();
  // const saveButton = document.getElementById('saveButton');
  // const edjsParser = edjsHTML({custom: customParser});

  // saveButton.addEventListener('click', function () {
  //   editor.save()
  //     .then((savedData) => {
  //       // cPreview.show(savedData, document.getElementById("output"));
  //       console.log(savedData);
  //       let html = edjsParser.parse(savedData);
        
  //       console.log(html);

  //     })
  //     .catch((error) => {
  //       console.error('Saving error', error);
  //     });
  // });

  // Graphs
  const ctx = document.getElementById('myChart')
  // eslint-disable-next-line no-unused-vars
  const myChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: [
        'Sunday',
        'Monday',
        'Tuesday',
        'Wednesday',
        'Thursday',
        'Friday',
        'Saturday'
      ],
      datasets: [{
        data: [
          15339,
          21345,
          18483,
          24003,
          23489,
          24092,
          12034
        ],
        lineTension: 0,
        backgroundColor: 'transparent',
        borderColor: '#007bff',
        borderWidth: 4,
        pointBackgroundColor: '#007bff'
      }]
    },
    options: {
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: false
          }
        }]
      },
      legend: {
        display: false
      }
    }
  })

  function convertDataToHtml(blocks) {
    var convertedHtml = "";
    blocks.map(block => {
      
      switch (block.type) {
        case "header":
          convertedHtml += `<h${block.data.level}>${block.data.text}</h${block.data.level}>`;
          break;
        case "embded":
          convertedHtml += `<div><iframe width="560" height="315" src="${block.data.embed}" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe></div>`;
          break;
        case "paragraph":
          convertedHtml += `<p>${block.data.text}</p>`;
          break;
        case "delimiter":
          convertedHtml += "<hr />";
          break;
        case "image":
          convertedHtml += `<img class="img-fluid" src="${block.data.file.url}" title="${block.data.caption}" /><br /><em>${block.data.caption}</em>`;
          break;
        case "list":
          convertedHtml += "<ul>";
          block.data.items.forEach(function(li) {
            convertedHtml += `<li>${li}</li>`;
          });
          convertedHtml += "</ul>";
          break;
        default:
          console.log("Unknown block type", block.type);
          break;
      }
    });
    return convertedHtml;
  }
  // Don't do this in production!


})()
