import {defineConfig} from 'vitepress'

export default defineConfig({
  title: 'iCalendar Plugin',
  description: 'Documentation for the iCalendar plugin',
  base: '/docs/icalendar/v1/',
  lang: 'en-US',
  head: [
    ['meta', {content: 'https://github.com/nystudio107', property: 'og:see_also',}],
    ['meta', {content: 'https://twitter.com/nystudio107', property: 'og:see_also',}],
    ['meta', {content: 'https://youtube.com/nystudio107', property: 'og:see_also',}],
    ['meta', {content: 'https://www.facebook.com/newyorkstudio107', property: 'og:see_also',}],
  ],
  themeConfig: {
    socialLinks: [
      {icon: 'github', link: 'https://github.com/nystudio107'},
      {icon: 'twitter', link: 'https://twitter.com/nystudio107'},
    ],
    logo: '/img/plugin-logo.svg',
    editLink: {
      pattern: 'https://github.com/nystudio107/craft-icalendar/edit/develop/docs/docs/:path',
      text: 'Edit this page on GitHub'
    },
    algolia: {
      appId: 'AE3HRUJFEW',
      apiKey: '7a365dc6dfe977be2c9588eb3ed5da26',
      indexName: 'icalendar',
      searchParameters: {
        facetFilters: ["version:v1"],
      },
    },
    lastUpdatedText: 'Last Updated',
    sidebar: [],
    nav: [
      {text: 'Home', link: 'https://nystudio107.com/plugins/icalendar'},
      {text: 'Store', link: 'https://plugins.craftcms.com/icalendar'},
      {text: 'Changelog', link: 'https://nystudio107.com/plugins/icalendar/changelog'},
      {text: 'Issues', link: 'https://github.com/nystudio107/craft-icalendar/issues'},
      {
        text: 'v1', items: [
          {text: 'v5', link: 'https://nystudio107.com/docs/icalendar/'},
          {text: 'v4', link: 'https://nystudio107.com/docs/icalendar/v4/'},
          {text: 'v1', link: '/'},
        ],
      },
    ]
  },
});
