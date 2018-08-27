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

					#content {
						margin: 0 auto;
						padding: 20px 0;
						width: 1000px;
					}

					table {
						border-collapse: collapse;
						margin: 40px auto;
						width: 100%;
					}

					table tr th,
					table tr td {
						font-size: 11px;
						padding: 8px;
						text-align: left;
					}

					table tr:nth-child(even) td {
						background-color: #efefef;
					}

					table tr th:last-of-type,
					table tr td:last-of-type {
						text-align: right;
					}

					table tr td a {
						color: #000;
					}
				</style>
			</head>
			<body>
				<xsl:apply-templates></xsl:apply-templates>
			</body>
		</html>
	</xsl:template>
	<xsl:template match="sitemap:urlset">
		<div id="content">
			<h1>XML Sitemap</h1>
			<table>
				<tr style="border-bottom: 1px #000 solid;">
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
		<div id="content">
			<h1>XML Sitemap Index</h1>
			<table>
				<tr style="border-bottom: 1px #000 solid;">
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
