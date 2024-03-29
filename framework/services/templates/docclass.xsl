<xsl:stylesheet 
	version="1.0" 
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
	xmlns:php="http://php.net/xsl"
	xmlns:ipub="http://www.ipublisher.nl/4.0"
	xmlns:exsl="http://exslt.org/common"
	xmlns:str="http://exslt.org/strings"
	xmlns:date="http://exslt.org/dates-and-times"
	extension-element-prefixes="str exsl date"
	>
<xsl:include href="str.replace.function.xsl"/>	
<xsl:output method="html" encoding="utf-8" indent="yes" doctype-public="-//W3C//DTD XHTML 1.0 Transitional//EN" doctype-system="http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd" media-type="text/html"/>

<xsl:template match="/model">
	<html>
	<head>
		<title>APONWAO WEBSERVICE BACKEND</title>
		<link rel="stylesheet" href="css/doc.css" type="text/css" ></link>
	</head>
	<body>
	<div id="main">
	<div id="mainheader">
	<div id="mainheaderpadded">
		<xsl:if test="class != ''">
			<h1><xsl:value-of select="class/name" /> <a href="{class/name}/wsdl">&#160;[WSDL]</a></h1>
		</xsl:if>
	</div>
	</div>
	<div id="mainpadded">
	<table cellpadding="0" cellspacing="0">
	<tr>
	<td id="menu">
		<h2>Servicios</h2>
		<xsl:for-each select="/model/menu/*">
			<a href="{name}"><xsl:value-of select="name"/></a><br />
		</xsl:for-each>
	</td>
	<td id="content">
			<xsl:if test="fault != ''">
				<xsl:value-of select="fault" />
			</xsl:if>
		<xsl:if test="class != '' and not(fault)">
			
			<h2>Descripci&#243;n del servicio</h2>
			<p><xsl:value-of select="class/fullDescription" /></p>
		
			<h2>Propiedades</h2>
			<xsl:for-each select="class/properties/*">
				<a name="property_{name}"></a>
				<div class="property{warning}">
				<b><xsl:value-of select="name" /></b><br />
				<xsl:choose>
					<xsl:when test="type != ''">
						<xsl:choose>
							<xsl:when test="contains('int,boolean,double,float,string,void', type)">
								<i>tipo <xsl:value-of select="type" /></i><br />
							</xsl:when>
							<xsl:otherwise>
								<i>tipo <a href="{str:replace(type,'[]','')}"><xsl:value-of select="type" /></a></i><br />
							</xsl:otherwise>
						</xsl:choose>
					</xsl:when>
					<xsl:otherwise>
						<div class='warning'><img src='images/doc/warning.gif'/> informaci&#243;n de tipo no encontrada</div><br />
					</xsl:otherwise>
				</xsl:choose>
				<xsl:value-of select="fullDescription" />
				</div>
			</xsl:for-each>
		
			<h2>M&#233;todos</h2>
			<xsl:for-each select="class/methods/*">
				<a name="method_{name}"></a>
				<div class="method{warning}">
				<b><xsl:value-of select="name" /></b>(
				<xsl:for-each select="params/*">
					<xsl:value-of select="name"/>
					<xsl:if test="position() != last()">,</xsl:if>
				</xsl:for-each>
				)
				<br />
				<xsl:choose>
					<xsl:when test="return != ''">
						<xsl:choose>
							<xsl:when test="contains('int,boolean,double,float,string,void', return)">
								<i>retorna <xsl:value-of select="return" /></i><br />
							</xsl:when>
							<xsl:otherwise>
								<i>retorna <a href="{str:replace(return,'[]','')}"><xsl:value-of select="return" /></a></i><br />
							</xsl:otherwise>
						</xsl:choose>
					</xsl:when>
					<xsl:otherwise>
						<div class='warning'><img src='images/doc/warning.gif'/> informaci&#243;n de retorno no encontrada</div><br />
					</xsl:otherwise>
				</xsl:choose>
				<xsl:choose>
					<xsl:when test="throws != ''">
						<i>produce una excepci&#243;n  <xsl:value-of select="throws" /></i><br />
					</xsl:when>
				</xsl:choose>
				<xsl:value-of select="fullDescription" /><br />
				</div>
			</xsl:for-each>
		</xsl:if>
	</td>
	</tr>
	</table>
		
	</div>
	<div id="mainfooter"><img src="images/doc/backbottom.jpg" /></div>
	</div>
	</body>
	</html>
</xsl:template>
</xsl:stylesheet>