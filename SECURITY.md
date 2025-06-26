# Security Policy

## Supported Versions

WittyWorkflow is committed to providing security updates for the following versions:

| Version | Supported          |
| ------- | ------------------ |
| 1.0.x   | :white_check_mark: |
| < 1.0   | :white_check_mark:                |

## Reporting a Vulnerability

We take the security of WittyWorkflow seriously. If you believe you've found a security vulnerability, please follow these steps:

1. **Email**: Send details to tanellari@gmail.com with subject line "WittyWorkflow Security Vulnerability"
2. **Include**:
   - Description of the vulnerability
   - Steps to reproduce
   - Potential impact
   - Any suggested fixes (if available)
3. **Response Time**: You can expect an initial response within 48 hours
4. **Disclosure**: Please allow time for the vulnerability to be addressed before public disclosure

## Security Features

WittyWorkflow includes several security features to protect your application:

- **Two-Factor Authentication (2FA)**: Enhanced login security using the Filament Breezy package
- **OTP Authentication**: One-time password support via the Filament OTP Login package
- **Role-Based Access Control**: Granular permissions using Filament Shield
- **Auto Logout**: Automatic session termination after periods of inactivity
- **Security Advisories**: Integration with Spatie's security advisories health check
- **CSRF Protection**: Built-in Laravel CSRF token verification
- **XSS Prevention**: HTML purification using Mews Purifier
- **Secure Payment Processing**: Stripe integration with Laravel Cashier

## Best Practices for Deployment

When deploying WittyWorkflow to production, we recommend:

1. **Environment Configuration**:
   - Use `.env` for sensitive configuration
   - Set `APP_DEBUG=false` in production
   - Configure proper `APP_ENV` values

2. **Database Security**:
   - Use strong, unique database credentials
   - Limit database user permissions
   - Enable database connection encryption

3. **Server Hardening**:
   - Keep server software updated
   - Configure proper firewall rules
   - Implement rate limiting
   - Use HTTPS with proper SSL/TLS configuration

4. **Regular Updates**:
   - Keep Laravel and all packages updated
   - Monitor security advisories
   - Apply security patches promptly

5. **Backups**:
   - Implement regular backups using Spatie Laravel Backup
   - Test backup restoration procedures
   - Store backups securely off-site

## Third-Party Dependencies

WittyWorkflow uses several third-party packages. We regularly monitor these dependencies for security vulnerabilities using:

- Spatie's security advisories health check
- GitHub's Dependabot alerts
- Composer's security audit features

## Responsible Disclosure

We appreciate the work of security researchers and the responsible disclosure of vulnerabilities. We commit to:

- Acknowledging receipt of vulnerability reports
- Verifying reported vulnerabilities in a timely manner
- Addressing confirmed vulnerabilities promptly
- Providing credit to researchers who responsibly disclose issues (upon request)
- Not pursuing legal action against researchers who follow responsible disclosure practices

## Security Updates and Patches

Security updates will be released as:

- Patch releases for critical vulnerabilities
- Regular updates as part of our release cycle
- Emergency hotfixes when necessary

Subscribe to our release notifications or regularly check for updates to ensure your installation remains secure.

---

Last Updated: June 2025
