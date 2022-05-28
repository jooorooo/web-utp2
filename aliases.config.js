const path = require('path')

function resolveSrc(_path) {
    return path.join(__dirname, 'resources/js/' + _path)
}

const aliases = {
//    '@': '',
   '@router': 'router',
   '@masonry': 'masonry',
   '@faIcons': 'faIcons',
//    '@layouts': 'router/layouts',
    '@components': 'components',
//    '@state': 'state',
//    '@models': 'models',
//    '@collections': 'collections',
    '@helpers': 'helpers',
//    '@mixins': 'mixins',
}

module.exports = {
    webpack: {},
    jest: {},
}

for (const alias in aliases) {
    module.exports.webpack[alias] = resolveSrc(aliases[alias])
    module.exports.jest['^' + alias + '/(.*)$'] = '<rootDir>/' + aliases[alias] + '/$1'
}
