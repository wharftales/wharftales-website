<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WharfTales - Run your sites easily.</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Geist:wght@100..900&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Geist', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background: #fff;
            color: #000;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            width: 100%;
            text-align: center;
        }

        h1 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 1rem;
            letter-spacing: -0.02em;
        }

        .tagline {
            font-size: 1.25rem;
            color: #666;
            margin-bottom: 1rem;
            font-weight: 300;
        }

        .subtitle {
            font-size: 1rem;
            color: #666;
            margin-bottom: 1rem;
            font-weight: 300;
        }

        .stats {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
            padding: 2rem 0;
            max-width: 400px;
            margin: auto;
            margin-bottom: 1rem;

        }

        .stat {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .stat-value {
            font-size: 1.5rem;
            font-weight: 700;
            line-height: 1;
        }

        .stat-label {
            font-size: 0.75rem;
            color: #999;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
            margin-bottom: 1rem;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            background: #000;
            color: #fff;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.875rem;
            border: 2px solid #000;
            border-radius: 50px;
            transition: all 0.2s ease;
        }

        .btn:hover {
            background: #fff;
            color: #000;
        }

        .btn-secondary {
            background: #fff;
            color: #000;
            border: 2px solid #000;
        }

        .btn-secondary:hover {
            background: #000;
            color: #fff;
        }

        .github-stars {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            background: #fff;
            color: #000;
            font-size: 0.875rem;
            margin-top: 1rem;
        }

        .star-icon {
            width: 16px;
            height: 16px;
        }

        .loading {
            color: #999;
        }

        .error {
            color: #999;
            font-size: 0.875rem;
        }

        @media (max-width: 640px) {
            h1 {
                font-size: 2.5rem;
            }

            .tagline {
                font-size: 1rem;
            }

            .stat-value {
                font-size: 1.25rem;
            }

            .buttons {
                flex-direction: column;
            }

            .btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <svg width="48" height="48" id="Logo" data-name="Logo" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1024 1024">
  <path fill="black" d="M651.36,159.58c-174.5,0-319.2,127.49-346.09,294.4-22.4-8.08-46.56-12.49-71.75-12.49-116.79,0-211.46,94.68-211.46,211.46s94.68,211.46,211.46,211.46l417.84-3.66c193.62,0,350.59-156.96,350.59-350.59s-156.96-350.59-350.59-350.59ZM758.92,431.26c-19.21,0-34.78-15.57-34.78-34.78s15.57-34.78,34.78-34.78,34.78,15.57,34.78,34.78-15.57,34.78-34.78,34.78Z"/>
</svg>
        <h1>WharfTales</h1>
        <p class="tagline">Run your sites easily.</p>
        <p class="subtitle">Deploy WordPress, Php, and Laravel sites on Docker.</p>

        <div class="stats">
            <?php
            // Fetch stats from API
            $stats = null;
            $error = null;
            
            try {
                $context = stream_context_create([
                    'http' => [
                        'timeout' => 5,
                        'ignore_errors' => true
                    ]
                ]);
                
                $response = @file_get_contents('https://telemetry.wharftales.org/api/stats', false, $context);
                
                if ($response !== false) {
                    $stats = json_decode($response, true);
                }
            } catch (Exception $e) {
                $error = $e->getMessage();
            }
            ?>

            <div class="stat">
                <div class="stat-value">
                    <?php 
                    if ($stats && isset($stats['active_installations'])) {
                        echo number_format($stats['active_installations']);
                    } else {
                        echo '<span class="loading">—</span>';
                    }
                    ?>
                </div>
                <div class="stat-label">Active Installations</div>
            </div>

            <?php /*
            <div class="stat">
                <div class="stat-value">
                    <?php 
                    if ($stats && isset($stats['total_installations'])) {
                        echo number_format($stats['total_installations']);
                    } else {
                        echo '<span class="loading">—</span>';
                    }
                    ?>
                </div>
                <div class="stat-label">Total Installations</div>
            </div>
            */ ?>

            <div class="stat">
                <div class="stat-value">
                    <?php 
                    if ($stats && isset($stats['total_sites'])) {
                        echo number_format($stats['total_sites']);
                    } else {
                        echo '<span class="loading">—</span>';
                    }
                    ?>
                </div>
                <div class="stat-label">Total Sites</div>
            </div>
        </div>

        <?php if ($error): ?>
            <p class="error">Unable to load stats</p>
        <?php endif; ?>



        <div class="buttons">
            <a href="https://github.com/wharftales/wharftales" class="btn" target="_blank" rel="noopener noreferrer">
                <svg class="star-icon" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.013 8.013 0 0016 8c0-4.42-3.58-8-8-8z"/>
                </svg>
                Download on GitHub
            </a>
            <a href="https://docs.wharftales.org" class="btn btn-secondary" target="_blank" rel="noopener noreferrer">
                View Documentation
            </a>
        </div>

        <div class="github-stars">
            <svg class="star-icon" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 .25a.75.75 0 01.673.418l1.882 3.815 4.21.612a.75.75 0 01.416 1.279l-3.046 2.97.719 4.192a.75.75 0 01-1.088.791L8 12.347l-3.766 1.98a.75.75 0 01-1.088-.79l.72-4.194L.818 6.374a.75.75 0 01.416-1.28l4.21-.611L7.327.668A.75.75 0 018 .25z"/>
            </svg>
            <span id="stars-count">
                <?php
                // Fetch GitHub stars
                $stars = null;
                $github_repo = 'giodc/wharftales';
                
                try {
                    $context = stream_context_create([
                        'http' => [
                            'method' => 'GET',
                            'header' => 'User-Agent: WharfTales-Website',
                            'timeout' => 5,
                            'ignore_errors' => true
                        ]
                    ]);
                    
                    $github_response = @file_get_contents("https://api.github.com/repos/{$github_repo}", false, $context);
                    
                    if ($github_response !== false) {
                        $github_data = json_decode($github_response, true);
                        if (isset($github_data['stargazers_count'])) {
                            $stars = number_format($github_data['stargazers_count']);
                        }
                    }
                } catch (Exception $e) {
                    // Silent fail
                }
                
                echo $stars ? "{$stars} stars" : "Star on GitHub";
                ?>
            </span>
        </div>
    </div>
</body>
</html>
