const path = require('path');
const destination = 'public/assets/scripts/';
module.exports = [
    {
        mode: 'development',
        entry: './Server/Views/Templates/Scripts/main.ts',
        devtool: 'inline-source-map',
        module: {
            rules: [
                {
                    test: /\.tsx?$/, // File must end with .ts or .tsx
                    use: 'ts-loader',
                    include: [path.resolve(__dirname, 'Server/Views/Templates/Scripts/')]
                }
            ]
        },
        resolve: {
            extensions: ['.tsx', '.ts', '.js']
        },
        output: {
            publicPath: destination,
            filename: 'bundle.js',
            path: path.resolve(__dirname, destination)
        },
        optimization: {
            mergeDuplicateChunks: true, // Tells webpack to merge chunks which contain the same modules.
            providedExports: true, // Tells webpack to figure out which exports are provided by modules to generate more efficient code for export * from ...
            removeAvailableModules: true, // Tells webpack to detect and remove modules from chunks when these modules are already included in all parents.
            usedExports: true, // <- remove unused function
        },
        watch: true,
        watchOptions: {
            aggregateTimeout: 200,
            poll: 1000, // Check for changes every second
            ignored: ['/node_modules', '/public', '/Server', '/vendor'],
        }
    }
];