<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados Test Coopersmith</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .email-container {
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px 20px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 300;
        }
        .header p {
            margin: 10px 0 0 0;
            opacity: 0.9;
            font-size: 16px;
        }
        .content {
            padding: 40px 30px;
        }
        .greeting {
            font-size: 18px;
            margin-bottom: 20px;
            color: #2c3e50;
        }
        .results-container {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 30px;
            margin: 30px 0;
            border-left: 4px solid #667eea;
            text-align: center;
        }
        .results-title {
            color: #2c3e50;
            font-size: 20px;
            margin-bottom: 20px;
            font-weight: 600;
        }
        .iframe-container {
            width: 100%;
            height: 600px;
            border: 2px solid #e9ecef;
            border-radius: 8px;
            overflow: hidden;
            background-color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .iframe-container iframe {
            width: 100%;
            height: 100%;
            border: none;
        }
        .fallback-link {
            margin-top: 20px;
            text-align: center;
        }
        .btn {
            display: inline-block;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 25px;
            font-weight: 500;
            transition: transform 0.2s;
        }
        .btn:hover {
            transform: translateY(-2px);
        }
        .footer {
            background-color: #2c3e50;
            color: white;
            text-align: center;
            padding: 30px 20px;
        }
        .footer p {
            margin: 5px 0;
        }
        .company-name {
            font-weight: 600;
            color: #3498db;
        }
        .disclaimer {
            font-size: 12px;
            opacity: 0.8;
            margin-top: 20px;
            line-height: 1.4;
        }

        /* Responsive */
        @media (max-width: 600px) {
            body {
                padding: 10px;
            }
            .content {
                padding: 20px;
            }
            .results-container {
                padding: 20px;
            }
            .iframe-container {
                height: 500px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>🎯 Test de Autoestima Coopersmith</h1>
            <p>Resultados de Evaluación Psicológica</p>
            <div style="margin-top: 15px;">
                <a href="https://dylgsolutionssac.net.pe/" target="_blank" style="display: inline-block; background-color: rgba(255,255,255,0.2); color: white; padding: 8px 20px; text-decoration: none; border-radius: 20px; font-size: 14px; border: 1px solid rgba(255,255,255,0.3); transition: all 0.3s ease;">
                    🚀 Desarrollado por DYLG Solutions
                </a>
            </div>
        </div>

        <div class="content">
            <div class="greeting">
                ¡Hola <strong>{{ $clientName }}</strong>!
            </div>

            <p>Has completado exitosamente el <strong>{{ $formName }}</strong>. A continuación puedes ver tus resultados detallados:</p>

            <div class="results-container">
                <div class="results-title">📊 Tus Resultados del Test</div>

                <div class="iframe-container">
                    <iframe
                        src="{{ $resultsUrl }}"
                        title="Resultados del Test de Autoestima Coopersmith"
                        loading="lazy">
                        <p>Tu navegador no soporta iframes. <a href="{{ $resultsUrl }}" target="_blank">Haz clic aquí para ver tus resultados</a>.</p>
                    </iframe>
                </div>

                <div class="fallback-link">
                    <a href="{{ $resultsUrl }}" target="_blank" class="btn">
                        📱 Ver Resultados en Nueva Ventana
                    </a>
                </div>
            </div>

            <div style="background-color: #e8f4fd; padding: 20px; border-radius: 8px; margin: 20px 0;">
                <h3 style="color: #2980b9; margin-top: 0;">📋 Información Importante:</h3>
                <ul style="color: #34495e; line-height: 1.6;">
                    <li><strong>Fecha del test:</strong> {{ now()->format('d/m/Y H:i') }}</li>
                    <li><strong>Validez:</strong> Este enlace estará disponible durante 30 días</li>
                    <li><strong>Privacidad:</strong> Tus resultados son confidenciales</li>
                    <li><strong>Consultas:</strong> Contacta con el profesional que administró tu test para interpretación personalizada</li>
                </ul>
            </div>

            <p style="color: #7f8c8d; font-style: italic; text-align: center; margin-top: 30px;">
                Este test es una herramienta de evaluación psicológica. Para una interpretación completa y recomendaciones personalizadas, consulta con un profesional de la salud mental.
            </p>
        </div>

        <div class="footer">
            <p><strong class="company-name">Test Autoestima CooperSmith</strong></p>
            <p>DYLG Solutions SAC</p>
            <p class="disclaimer">
                Este email fue generado automáticamente por nuestro sistema de evaluaciones psicológicas.
                Por favor, no respondas a este correo. Para consultas, contacta directamente con el profesional que administró tu test.
            </p>
        </div>
    </div>
</body>
</html>
