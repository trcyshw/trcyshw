<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:html="http://www.w3.org/TR/REC-html40" xmlns:sitemap="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
	<xsl:output method="html" version="1.0" encoding="UTF-8" indent="yes" />
	<xsl:template match="/">
		<html xmlns="http://www.w3.org/1999/xhtml">
			<head>
				<title>XML Sitemap</title>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
				<meta name="robots" content="noindex,follow" />
				<style type="text/css">
					body {
						font-family: Helvetica, Arial, sans-serif;
						font-size: 13px;
					}

					.sitemap {
						margin: 0 auto;
						padding: 20px 0;
						width: 1000px;
					}

					.sitemap h1 {
						text-align: center;
					}

					.sitemap table {
						border-collapse: collapse;
						margin: 40px auto;
						width: 100%;
					}

					.sitemap table tr th,
					.sitemap table tr td {
						font-size: 11px;
						padding: 8px;
						text-align: left;
					}

					.sitemap table tr:nth-child(even) td {
						background-color: rgb(245, 245, 245);
					}

					.sitemap table tr th:last-of-type,
					.sitemap table tr td:last-of-type {
						text-align: right;
					}

					.sitemap table tr td a {
						color: rgb(0, 0, 0);
					}

					.sitemap .sitemap__footer {
						color: rgb(128, 128, 128);
						font-size: 11px;
						text-align: center;
					}

					.sitemap__footer a {
						color: rgb(128, 128, 128);
					}
				</style>
			</head>
			<body>
				<xsl:apply-templates></xsl:apply-templates>
			</body>
		</html>
	</xsl:template>
	<xsl:template match="sitemap:urlset">
		<div class="sitemap">
			<h1>XML Sitemap</h1>
			<table>
				<tr style="border-bottom:1px rgb(0, 0, 0) solid;">
					<th>URL</th>
					<th>Last modified (GMT)</th>
				</tr>
				<xsl:variable name="lower" select="'abcdefghijklmnopqrstuvwxyz'"/>
				<xsl:variable name="upper" select="'ABCDEFGHIJKLMNOPQRSTUVWXYZ'"/>
				<xsl:for-each select="./sitemap:url">
					<tr>
						<td>
							<xsl:variable name="itemURL">
								<xsl:value-of select="sitemap:loc"/>
							</xsl:variable>
							<a href="{$itemURL}">
								<xsl:value-of select="sitemap:loc"/>
							</a>
						</td>
						<td>
							<xsl:value-of select="concat(substring(sitemap:lastmod,0,11),concat(' ', substring(sitemap:lastmod,12,5)))"/>
						</td>
					</tr>
				</xsl:for-each>
			</table>
		</div>
	</xsl:template>
	<xsl:template match="sitemap:sitemapindex">
		<div class="sitemap">
			<h1>XML Sitemap Index</h1>
			<table>
				<tr style="border-bottom:1px rgb(0, 0, 0) solid;">
					<th>URL of sub-sitemap</th>
					<th>Last modified (GMT)</th>
				</tr>
				<xsl:for-each select="./sitemap:sitemap">
					<tr>
						<td>
							<xsl:variable name="itemURL">
								<xsl:value-of select="sitemap:loc"/>
							</xsl:variable>
							<a href="{$itemURL}">
								<xsl:value-of select="sitemap:loc"/>
							</a>
						</td>
						<td>
							<xsl:value-of select="concat(substring(sitemap:lastmod,0,11),concat(' ', substring(sitemap:lastmod,12,5)))"/>
						</td>
					</tr>
				</xsl:for-each>
			</table>
		</div>
	</xsl:template>
</xsl:stylesheet>